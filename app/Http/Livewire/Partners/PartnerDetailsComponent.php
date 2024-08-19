<?php

namespace App\Http\Livewire\Partners;

use App\Models\Partner;
use App\Models\Property;
use Livewire\Component;
use Livewire\WithPagination;
use App\Http\CustomHelpers;
use App\Models\Destination;
use App\Models\Offer;

use App\Models\PropertyType;
use App\Models\Rate;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Session;



class PartnerDetailsComponent extends Component
{
    use WithPagination;

    public $checkIn;
    public $checkOut;
    public $noOfNights = 1;

    // set pagination theme to bootstrap (default tailwind)
    protected $paginationTheme = 'bootstrap';

    public $isLocal = false;


    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;



        // $today = Carbon::now();
        // $tomorrow = Carbon::tomorrow();

        // get todat and tomorrow as a date (ex:2023-01-01)
        // $today = $today->toDateString();
        // $tomorrow = $tomorrow->toDateString();

        // set checkin and checkout dates

        // $this->checkIn =  $checkIn ?? $today;
        // $this->checkOut =  $checkOut ?? $tomorrow;

        // calculate number of nights between the checkin and checkout
        // $this->noOfNights = (new DateTime($this->checkIn))->diff(new DateTime($this->checkOut))->days;

        // $category = PropertyType::where(['slug' => $slug])->first();
        // if ($category) {
        //     $this->type = $category->id;
        // }

        // if($this->d_id) {
        //     $this->destination = $this->d_id;
        // }
        
        if(Session::has('currency') && Session::get('currency')) {
            $currency = Session::get('currency');
            if($currency == 'usd') {
                $this->isLocal = false;
            } else {
                $this->isLocal = true;
            }
        } else {
            // $this->isLocal = true;
            $this->isLocal = CustomHelpers::isLocalCountry();
        }
        // $this->partner = Partner::with('properties')->find($name);
    }

    public function render()
    {
        $partner = Partner::with('properties')->where(['id'=>$this->slug])->first();
        $properties = Property::where(['partner_id'=>$partner->id, 'status'=>1])->get();

        return view('livewire.partners.partner-details-component', compact('partner', 'properties'))->layout('frontend');
    }
    public function updated()
    {
        $this->resetPage();
    }

    public function getLowestRate($propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $rooms = $property->rooms()->get();
        
        $ratesArr = [];
        foreach ($rooms as $key => $room) {
            $rates = Rate::where(['property_id' => $propertyId, 'room_id' => $room->id, 'status'=>1]);

            foreach ($room->bedTypes as $key => $bedType) {
                foreach ($room->mealTypes as $key => $mealType) {
                    $data = [
                        'bedType'=>$bedType->id,
                        'mealType'=>$mealType->id,
                        'childQty'=>0,
                        'bedsQty' => 0,
                    ];
                    $typeRate = CustomHelpers::calculateTotalRates($this->isLocal, $rates, $this->checkIn, $this->checkOut, [], 1, $data);

                    if($typeRate > 0) {
                        array_push($ratesArr, $typeRate);
                    }
                }
            }
        }
        $minRate = count($ratesArr) > 0 ? min($ratesArr) :0;

        return $minRate;
    }

    public function getLowestOfferRate($propertyId)
    {
        $property = Property::findOrFail($propertyId);

        $offerRooms = $property->offers()->where(['type'=>1])->first();

        $rooms = $property->rooms()->whereIn('id',json_decode($offerRooms?$offerRooms->room_type_id:'[]'))->get();
        
        $ratesArr = [];
        // dd($rooms);
        foreach ($rooms as $key => $room) {
            $offers = Offer::where(['property_id' => $propertyId, 'status'=>1])->whereJsonContains('room_type_id', "{$room->id}");
            $rates = Rate::where(['property_id' => $propertyId, 'room_id' => $room->id, 'status'=>1]);

            foreach ($room->bedTypes as $key => $bedType) {
                if(in_array($bedType->id, json_decode($offerRooms->bed_type_id))) {
                    foreach ($room->mealTypes as $key => $mealType) {
                        $data = [
                            'bedType'=>$bedType->id,
                            'mealType'=>$mealType->id,
                            'childQty'=>0,
                            'bedsQty' => 0,
                        ];
                        if(in_array($mealType->id, json_decode($offerRooms->meal_type_id))) {

                            $typeRate = CustomHelpers::calculateTotalRates($this->isLocal, $rates, $this->checkIn, $this->checkOut, [], 1, $data, $offers, 1);
                            if($typeRate > 0) {
                                array_push($ratesArr, $typeRate);
                            }
                        }
    
                    }
                }

            }
        }
        // dd($ratesArr);
        $minRate = count($ratesArr) > 0 ? min($ratesArr) :0;

        return $minRate;
    }

    public function displayCurrency($amount) {
        $currency = $this->isLocal ? 'Rs':'USD';
        $amount = number_format($amount, 2, '.', ',');
        return $currency . ' ' . $amount;
    }

    public function changeCurrency($currency) {
        Session::put('currency', $currency);
        if(Session::has('currency') && Session::get('currency')) {
            $currency = Session::get('currency');
            if($currency == 'usd') {
                $this->isLocal = false;
            } else {
                $this->isLocal = true;
            }
        } else {
            // $this->isLocal = true;
            $this->isLocal = CustomHelpers::isLocalCountry();
        }
    }
}
