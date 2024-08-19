<?php

namespace App\Http\Livewire\Property;

use App\Http\CustomHelpers;
use App\Models\Offer;
use App\Models\Property;
use App\Models\Rate;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;
use BookingCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RoomBedTypeComponent extends Component
{
    use LivewireAlert;

    // component props
    public $room;
    public $bedType;
    public $checkIn;
    public $checkOut;
    public $noOfNights = 1;
    public $isLocal;

    // form fields
    public $mealType;
    public $roomQty = 1;
    public $showExtraBeds = false;
    public $extraBedsQty = 0;
    public $showExtraChild = false;
    public $extraChildQty = 0;

    protected $listeners = [
        'refreshComponent' =>'$refresh',
        'confirmed'
    ];

    public function mount($room, $bedType, $checkIn = null, $checkOut = null, $isLocal = false)
    {
        $this->room = $room;
        $this->bedType = $bedType;

        // set default value for meal type
        $this->mealType = !empty($room->mealTypes) ? $room->mealTypes[0]->id : null;

        // get today and tomorrow dates
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();

        // get todat and tomorrow as a date (ex:2023-01-01)
        $today = $today->toDateString();
        $tomorrow = $tomorrow->toDateString();

        // set checkin and checkout dates

        $this->checkIn =  $checkIn ?? $today;
        $this->checkOut =  $checkOut ?? $tomorrow;

        // calculate number of nights between the checkin and checkout
        $this->noOfNights = (new DateTime($this->checkIn))->diff(new DateTime($this->checkOut))->days;
    }

    public function render()
    {
        // $this->getOffer();
        $totalPrice = $this->getRatesTotal();
        $offerPrice = $this->getOfferRate();

        $partialPayAmount = $this->getPartialPayAmount($totalPrice);
        return view('livewire.property.room-bed-type-component', compact('totalPrice','offerPrice', 'partialPayAmount'));
    }

    public function setRoomQty($operation = null)
    {
        if ($operation == '+') {
            if ((int)$this->room->quantity > (int)$this->roomQty) {
                $this->roomQty++;
            }
        } else {
            if ((int)$this->roomQty > 1) {
                $this->roomQty--;
            }
        }
    }

    public function enableExtraBeds() {
        $this->showExtraBeds = !$this->showExtraBeds;
        $this->extraBedsQty = 0;
    }

    public function setExtraBedsQty($operation = null)
    {
        if ($operation == '+') {
            if ((int)$this->room->max_extra_beds > (int)$this->extraBedsQty) {
                $this->extraBedsQty++;
            }
        } else {
            if ((int)$this->extraBedsQty > 0) {
                $this->extraBedsQty--;
            }
        }
    }

    public function enableExtraChild() {
        $this->showExtraChild = !$this->showExtraChild;
        $this->extraChildQty = 0;
    }

    public function setExtraChildQty($operation = null)
    {
        if ($operation == '+') {
            if ((int)$this->room->max_child > (int)$this->extraChildQty) {
                $this->extraChildQty++;
            }
        } else {
            if ((int)$this->extraChildQty > 0) {
                $this->extraChildQty--;
            }
        }
    }

    public function getRatesTotal()
    {
        $data = [
            'bedType'=>$this->bedType->id,
            'mealType'=>$this->mealType,
            'childQty'=>$this->extraChildQty,
            'bedsQty' => $this->extraBedsQty,
        ];
        $rates = Rate::where(['property_id' => $this->room->property_id, 'room_id' => $this->room->id, 'status'=>1]);
        // Calculate the total price for the selected nights
        $holidays = [
            // '2023-05-13',
            // '2023-05-14',
            '2023-05-15',
        ];
        
        $totalPrice = 0;

        $price = CustomHelpers::calculateTotalRates($this->isLocal,$rates, $this->checkIn, $this->checkOut, $holidays, $this->noOfNights, $data);
            
        $totalPrice = ((float)$price * (int)$this->roomQty);
        return $totalPrice;
    }

    public function getOfferRate()
    {
        $data = [
            'bedType'=>$this->bedType->id,
            'mealType'=>$this->mealType,
            'childQty'=>$this->extraChildQty,
            'bedsQty' => $this->extraBedsQty,
        ];

        $rates = Rate::where(['property_id' => $this->room->property_id, 'room_id' => $this->room->id, 'status'=>1]);

        $offers = Offer::where(['property_id' => $this->room->property_id, 'status'=>1])->whereJsonContains('room_type_id', "{$this->room->id}");
           
        $totalPrice = 0;
        $price = CustomHelpers::calculateTotalRates($this->isLocal, $rates, $this->checkIn, $this->checkOut, [], 1, $data, $offers, 1);
                            
        $totalPrice = ((float)$price * (int)$this->roomQty);
        return $totalPrice;
    }

    public function displayCurrency($amount)
    {
        $property = Property::where(['id' => $this->room->property_id])->with('currencies')->first();
        $defaultCurrency = $property->currencies->firstWhere('pivot.default', 1);
        if ($defaultCurrency) {
            $defaultCurrencyname = $defaultCurrency->name;
        } else {
            $defaultCurrencyname = "LKR";
        }


        $secondaryCurrency = $property->currencies->firstWhere('pivot.default', 0);
        if ($secondaryCurrency) {
            $secondaryCurrencyname = $secondaryCurrency->name;
        } else {
            $secondaryCurrencyname = "";
        }
        if($this->isLocal == $defaultCurrencyname){
           
            $amount = number_format($amount, 0, '.', ',');
            return $defaultCurrencyname . ' ' . $amount;
        }else{

            $amount = number_format($amount, 0, '.', ',');
            return $secondaryCurrencyname . ' ' . $amount;
        }

       
       
        
    }

    // function to calculate the offer
    // public function getOffer()
    // {
    //     $data = [
    //         'bedType'=>$this->bedType->id,
    //         'mealType'=>$this->mealType,
    //         'childQty'=>$this->extraChildQty,
    //         'bedsQty' => $this->extraBedsQty,
    //     ];

    //     $offerRate = Offer::where(['property_id' => $this->room->property_id, 'status'=>1])->whereJsonContains('room_type_id',"{$this->room->id}");

    //      // Calculate the total price for the selected nights
    //      $holidays = [
    //         // '2023-05-13',
    //         // '2023-05-14',
    //         '2023-05-15',
    //     ];

    //     $priceAfterOffer = 0;

    //     $offerAmount = 0; 
    //     $totalPrice = 0;

    //     $price = CustomHelpers::calculateOffer($offerRate,0, $this->checkIn, $this->checkOut, $holidays, $this->noOfNights, $data);

    //     $priceAfterOffer = $totalPrice - $offerAmount ;
    //     return $priceAfterOffer;

    // }

    public function getPartialPayAmount($total) {
        $property = Property::find($this->room->property_id);

        if($property) {
            if($property->partial_pay_type == 'percentage') {
                $amount = $total * ($property->partial_pay_amount/100);
            } else {
                $amount = $property->partial_pay_amount * $this->noOfNights;
            }
        } else {
            $amount = 0;
        }
        return $amount;
    }

    public function makeReservetion($partialAmount = null, $amount = 0) {
        $data = [
            'room_id'=>$this->room->id,
            'property_id'=>$this->room->property_id,
            'meal_type'=>$this->mealType,
            'bed_type'=>$this->bedType->id,
            'check_in'=>$this->checkIn,
            'check_out'=>$this->checkOut,
            'no_of_nights'=>$this->noOfNights,
            'room_qty'=>$this->roomQty,
            'extra_beds'=>$this->extraBedsQty,
            'extra_child'=>$this->extraChildQty,
            'partial_paid_amount'=>$partialAmount,
            'total_amount'=>$amount
        ];


        $cart = BookingCart::instance('booking')->content();

        $property = $cart->contains(function ($cartItem, $key) {
            return (($cartItem->options->has('property_id')?$cartItem->options->property_id:'') == $this->room->property_id);
        });

        // dd(!$property && $cart->count() > 0);

        if(!$property && $cart->count() > 0) {
            $this->alert('warning', '', [
                'position' => 'center',
                'timer' => '',
                'toast' => true,
                'showConfirmButton' => true,
                'onConfirmed' => 'confirmed',
                'showCancelButton' => true,
                'onDismissed' => '',
                'confirmButtonText' => 'Confirm',
                'width' => '',
                'text' => 'Reserve list already has room(s) from another property. Clear cart?',
                'inputAttributes'=>[
                    'partialAmount'=>$partialAmount,
                    'amount'=>$amount,
                    'data'=>$data
                ]
               ]);
               return;
        }

        // dd($property);

        $alreadyInCart = $cart->contains(function ($cartItem, $key) {
            return ($cartItem->id == $this->room->id) && (($cartItem->options->has('bed_type')?$cartItem->options->bed_type:'') == $this->bedType->id);
        });
        // dd( $cart);
        if(!$alreadyInCart) {
            BookingCart::instance('booking')->add($this->room->id, $this->room->name, $this->roomQty, $partialAmount?$partialAmount:$amount, $data);
        }
        $this->emitTo('cart.cart-component', 'refreshComponent');   
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function confirmed($res)
    {
        $partialAmount = $res['data']['inputAttributes']['partialAmount'];
        $amount = $res['data']['inputAttributes']['amount'];
        $data = $res['data']['inputAttributes']['data'];
        
        BookingCart::instance('booking')->destroy();

        $cart = BookingCart::instance('booking')->content();
        
        $alreadyInCart = $cart->contains(function ($cartItem, $key) {
            return ($cartItem->id == $this->room->id) && (($cartItem->options->has('bed_type')?$cartItem->options->bed_type:'') == $this->bedType->id);
        });
        // dd( $res['data']['inputAttributes']);

        if(!$alreadyInCart) {
            BookingCart::instance('booking')->add($this->room->id, $this->room->name, $this->roomQty, $partialAmount?$partialAmount:$amount, $data);
        }
        $this->emitTo('cart.cart-component', 'refreshComponent');   
        $this->dispatchBrowserEvent('contentChanged');
        // dd('4564654');
    }
}
