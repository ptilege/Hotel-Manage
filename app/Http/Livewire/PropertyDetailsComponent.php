<?php

namespace App\Http\Livewire;

use App\Models\Review;
use App\Http\CustomHelpers;
use App\Models\Amenity;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\FacilitiesProperty;
use App\Models\Property;
use App\Models\Offer;
use App\Models\Rate;
use App\Models\Facilities;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use BookingCart;

class PropertyDetailsComponent extends Component
{
    use LivewireAlert;

    public $slug;
    public $Cleanliness = 0;
    public $Staffrate = 0;
    public $Comfort = 0;
    public $Valueformoney = 0;
    public $Facilities = 0;
    public $Location = 0;
    public $heading;
    public $comment;
    public $checkIn;
    public $checkOut;
    public $noOfNights = 1;
    public $comfortaverage = 0;
    public $facilitiesaverage = 0;
    public $cleanlinessaverage = 0;
    public $valueformoneyaverage = 0;
    public $staffaverage = 0;
    public $locationaverage = 0;


    // for query string
    public $check_in = '';
    public $check_out = '';

    public $isLocal;
    public $cartCount;

    protected $listeners = ['updateCartCount',   'refreshComponent' => '$refresh', 'confirmed'];

    protected $queryString = ['check_in' => ['except' => ''], 'check_out' => ['except' => '']];

    // protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount($slug)
    {
        // get slug from request url
        $this->slug = $slug;

        // get today and tomorrow dates
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();

        // get todat and tomorrow as a date (ex:2023-01-01)
        $today = $today->toDateString();
        $tomorrow = $tomorrow->toDateString();

        // set default checkin and checkout dates
        $this->checkIn = $this->check_in ? $this->check_in : $today;
        $this->checkOut = $this->check_out ? $this->check_out : $tomorrow;

        // calculate number of nights between the checkin and checkout
        $this->noOfNights = (new DateTime($this->checkIn))->diff(new DateTime($this->checkOut))->days;
        
        if(Session::has('currency') && Session::get('currency')) {
            $currency = Session::get('currency');
            if($currency == 'USD') {
                $this->isLocal = "USD";
            } elseif($currency == 'LKR') {
                $this->isLocal = "LKR";
            }
        } else {
            // $this->isLocal = true;
            $this->isLocal = CustomHelpers::isLocalCountry();
        }
        $property = Property::where(['slug' => $this->slug])->with('currencies')->first();
        $defaultCurrency = $property->currencies->firstWhere('pivot.default', 1);
            if ($defaultCurrency) {
                $defaultCurrencyname = $defaultCurrency->name;
                $this->isLocal = $defaultCurrencyname;
                Session::put('currency', $defaultCurrencyname);
            } else {
                $defaultCurrencyname = "LKR";
                Session::put('currency', "LKR");
            }

        
    }

    public $bookingNumber;
    public $bookingStatus;

    public function rateStay()
    {
        $property = Property::where(['slug' => $this->slug])->first();

        $propertyId = $property->id;
        $this->emit('reviewrateStay');
        if (auth('customers')->check()) {
            $userEmail = auth('customers')->user()->email;
            $userId = auth('customers')->user()->id;
            $bookingid = $this->bookingNumber;
            $booking = Booking::where(['status' => 'confirm', 'property_id' => $propertyId, 'id' => $bookingid, 'email' => $userEmail])->get();

            if ($booking->isEmpty()) {
                // No booking found
                $bookingStatus = '0';
                $this->bookingStatus =  $bookingStatus;
                $this->emit('reviewrateStay');
            } else {
                // Booking found
                $existingReview = Review::where(['property_id' => $propertyId, 'user_id' => $userId])->first();
                if ($existingReview) {
                    $bookingStatus = '2';
                    $this->bookingStatus = $bookingStatus;
                } else {
                    $bookingStatus = '1';
                    $this->bookingStatus =  $bookingStatus;
                    $this->emit('reviewrateStay');
                    $this->emit('openThirdModal');
                }
            }
        } else {
            $bookingStatus = '0';
            $this->bookingStatus = $bookingStatus;
        }
        $this->bookingNumber = '';
        return $bookingStatus;
    }

    public function render()
    {
        $property = Property::where(['slug' => $this->slug])->with('currencies')->first();
        $destinationid = $property->destination_id;
        $propertyId = $property->id;
        // $destination = Destination::findOrFail($destinationid);

        $propeties = Property::where(['status' => 1, 'destination_id' => $destinationid])->with('featuredMedia')->get();
        $highlights = Amenity::where(['status' => 1, 'property_id' => $propertyId])->limit(6)->get();
        $amenities = Amenity::where(['status' => 1, 'property_id' => $propertyId])->limit(9)->get();
        $facilitiesIds = FacilitiesProperty::where(['property_id' => $propertyId])->pluck('facilities_id')->toArray();
        $facilities = Facilities::whereIn('id', $facilitiesIds)->where('status', 1)->orderby('position')->limit(9)->get();
        // dd($facilities);

        $bookings = Booking::where(['status' => 'confirm', 'property_id' => $propertyId])->get();

        // Dump and die to inspect the results
        // dd($facilities);

        // $reviews = Review::where(['property_id'=> $propertyId])->pluck('comfort');
        $comfortValues = Review::where(['property_id' => $propertyId])->pluck('comfort')->toArray();
        if (!empty($comfortValues)) {
            $sum = array_sum($comfortValues);
            $count = count($comfortValues);
            $comfortaverage = $count > 0 ? $sum / $count : 0;

            // dd($comfortaverage);
            $this->comfortaverage =  $comfortaverage;
        } else {
            $this->comfortaverage =  0;
        }
        $facilitiesValues = Review::where(['property_id' => $propertyId])->pluck('facilities')->toArray();
        if (!empty($facilitiesValues)) {
            $sum = array_sum($facilitiesValues);
            $count = count($facilitiesValues);
            $facilitiesaverage = $count > 0 ? $sum / $count : 0;

            // dd($comfortaverage);
            $this->facilitiesaverage =  $facilitiesaverage;
        } else {
            $this->facilitiesaverage =  0;
        }
        $cleanlinessValues = Review::where(['property_id' => $propertyId])->pluck('cleanliness')->toArray();
        if (!empty($cleanlinessValues)) {
            $sum = array_sum($cleanlinessValues);
            $count = count($cleanlinessValues);
            $cleanlinessaverage = $count > 0 ? $sum / $count : 0;

            // dd($comfortaverage);
            $this->cleanlinessaverage =  $cleanlinessaverage;
        } else {
            $this->cleanlinessaverage =  0;
        }
        $valueformoneyValues = Review::where(['property_id' => $propertyId])->pluck('valueformoney')->toArray();
        if (!empty($valueformoneyValues)) {
            $sum = array_sum($valueformoneyValues);
            $count = count($valueformoneyValues);
            $valueformoneyaverage = $count > 0 ? $sum / $count : 0;

            // dd($comfortaverage);
            $this->valueformoneyaverage =  $valueformoneyaverage;
        } else {
            $this->valueformoneyaverage =  0;
        }
        $staffValues = Review::where(['property_id' => $propertyId])->pluck('staff')->toArray();
        if (!empty($staffValues)) {
            $sum = array_sum($staffValues);
            $count = count($staffValues);
            $staffaverage = $count > 0 ? $sum / $count : 0;

            // dd($comfortaverage);
            $this->staffaverage =  $staffaverage;
        } else {
            $this->staffaverage =  0;
        }
        $locationValues = Review::where(['property_id' => $propertyId])->pluck('location')->toArray();
        if (!empty($locationValues)) {
            $sum = array_sum($locationValues);
            $count = count($locationValues);
            $locationaverage = $count > 0 ? $sum / $count : 0;

            // dd($comfortaverage);
            $this->locationaverage =  $locationaverage;
        } else {
            $this->locationaverage =  0;
        }

        $reviewDetails = Review::join('frontend_users', 'reviews.user_id', '=', 'frontend_users.id')
            ->where(['property_id' => $propertyId])
            ->get(['reviews.id as review_id', 'frontend_users.id as user_id', 'reviews.*', 'frontend_users.*']);

        // dd($reviewDetails);
        $reviewcount = Review::where(['property_id' => $propertyId])->count();
        $fullreviewcount = ($this->comfortaverage + $this->facilitiesaverage + $this->cleanlinessaverage + $this->valueformoneyaverage + $this->locationaverage + $this->staffaverage) / 6;

        if (auth('customers')->check()) {
            $userEmaildelte = auth('customers')->user()->email;
        } else {
            $userEmaildelte = null;
        }
        // dd($userEmaildelte);
        $rooms = $property->rooms()->with(['bedTypes', 'mealTypes', 'media'])->get();
        $holidays = [
            '2023-05-10',
            '2023-05-11',
            '2023-05-12',
        ];


        $cartCount = count(BookingCart::instance('booking')->content());
        $this->cartCount = $cartCount;
      
        
        
        $defaultCurrency = $property->currencies->firstWhere('pivot.default', 1);
        $secondaryCurrency = $property->currencies->firstWhere('pivot.default', 0);
        if ($defaultCurrency) {
            $defaultCurrencyname = $defaultCurrency->name;
;
        } else {
            $defaultCurrencyname = "LKR";

        }

       
        if ($secondaryCurrency) {
            $secondaryCurrencyname = $secondaryCurrency->name;
        } else {
            $secondaryCurrencyname = "";
        }




        return view('livewire.property-details-component', compact('property', 'rooms', 'amenities', 'highlights', 'propeties', 'facilities', 'bookings', 'reviewDetails', 'fullreviewcount', 'reviewcount', 'userEmaildelte', 'defaultCurrencyname', 'secondaryCurrencyname'))->layout('frontend');
    }

    public function updateCartCount($cartCount)
    {
        $this->cartCount = $cartCount;
        // dd($cartCount);
    }
    public function deleteReview($reviewId)
    {


        $review = Review::find($reviewId);
        if ($review) {
            $review->delete();

            $this->alert('success', 'Delete Successfully.', [
                'position' => 'top-end',
                'timer' => 3000,
                'timerProgressBar' => true,
                // 'text' => 'Optional additional text here',
            ]);
            $this->emit('reviewDeleted');
        } else {
            // If review with $reviewId is not found
            $this->alert('error', 'Review not found.', [
                'position' => 'top-end',
                'timer' => 3000,
                'timerProgressBar' => true,
                // 'text' => 'Optional additional text here',
            ]);
        }
    }
    public function updated()
    {
        $this->noOfNights = (new DateTime($this->checkIn))->diff(new DateTime($this->checkOut))->days;
    }

    public function addReview()
    {
        // Validate the input if needed
        $this->validate([

            'heading' => 'required',
            'comment' => 'required',
        ]);
        $property = Property::where(['slug' => $this->slug])->first();
        $propertyId = $property->id;

        $userId = auth('customers')->user()->id;

        // dd($this->Comfort);
        // Create a new review
        $review = Review::create([
            'property_id' => $propertyId,
            'user_id' => $userId,
            'heading' => $this->heading,
            'comment' => $this->comment,
            'comfort' => $this->Comfort,
            'valueformoney' => $this->Valueformoney,
            'facilities' => $this->Facilities,
            'location' => $this->Location,
            'cleanliness' => $this->Cleanliness,
            'staff' => $this->Staffrate,

            // Add any other fields you need
        ]);
        if ($review) {
            // Show success alert
            $this->alert('success', 'Review added successfully.', [
                'position' => 'top-end',
                'timer' => 3000,
                'timerProgressBar' => true,
                // 'text' => 'Optional additional text here',
            ]);

            $this->reset(['heading', 'comment', 'Comfort', 'Valueformoney', 'Facilities', 'Location', 'Cleanliness', 'Staffrate']);
            $this->emit('closeThirdModal');
            // Emit a custom event to trigger a page reload
            $this->emit('reloadPage');
        } else {
            // If review creation fails, show an error alert
            $this->alert('error', 'Failed to add review.', [
                'position' => 'top-end',
                'timer' => 3000,
                'timerProgressBar' => true,
                // 'text' => 'Optional additional text here',
            ]);
        }
    }
    public function getLowestRate($propertyId)
    {
        $property = Property::findOrFail($propertyId);
        $rooms = $property->rooms()->get();

        $ratesArr = [];
        foreach ($rooms as $key => $room) {
            $rates = Rate::where(['property_id' => $propertyId, 'room_id' => $room->id, 'status' => 1]);

            foreach ($room->bedTypes as $key => $bedType) {
                foreach ($room->mealTypes as $key => $mealType) {
                    $data = [
                        'bedType' => $bedType->id,
                        'mealType' => $mealType->id,
                        'childQty' => 0,
                        'bedsQty' => 0,
                    ];
                    $typeRate = CustomHelpers::calculateTotalRates($this->isLocal, $rates, $this->checkIn, $this->checkOut, [], 1, $data);

                    if ($typeRate > 0) {
                        array_push($ratesArr, $typeRate);
                    }
                }
            }
        }
        $minRate = count($ratesArr) > 0 ? min($ratesArr) : 0;

        return $minRate;
    }

    public function displayCurrency($amount)
    {
        $property = Property::where(['slug' => $this->slug])->with('currencies')->first();
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

    public function changeCurrency($currency)
    {
        $cart = BookingCart::instance('booking')->content();
        if (!$cart->isEmpty()) {
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
                'text' => 'If you try to change Currency method will Clear Cart. Clear cart?',
                'inputAttributes' => [
                    'currency' => $currency,

                ]
            ]);
        } else {
               
            Session::put('currency', $currency);
            if (Session::has('currency') && Session::get('currency')) {
                $currency = Session::get('currency');
                if ($currency == 'USD') {
                    $this->isLocal = 'USD';
                } elseif($currency == 'LKR') {
                    $this->isLocal = 'LKR';
                }
                $this->emitTo('cart.cart-component', 'refreshComponent'); 
            } else {
                // $this->isLocal = true;
                $this->isLocal = CustomHelpers::isLocalCountry();
                $this->emitTo('cart.cart-component', 'refreshComponent'); 
            }
              
            
        }
    }
    public function getLowestOfferRate($propertyId)
    {
        $property = Property::findOrFail($propertyId);

        $offerRooms = $property->offers()->where(['type' => 1])->first();

        $rooms = $property->rooms()->whereIn('id', json_decode($offerRooms ? $offerRooms->room_type_id : '[]'))->get();

        $ratesArr = [];
        // dd($rooms);
        foreach ($rooms as $key => $room) {
            $offers = Offer::where(['property_id' => $propertyId, 'status' => 1])->whereJsonContains('room_type_id', "{$room->id}");
            $rates = Rate::where(['property_id' => $propertyId, 'room_id' => $room->id, 'status' => 1]);

            foreach ($room->bedTypes as $key => $bedType) {
                if (in_array($bedType->id, json_decode($offerRooms->bed_type_id))) {
                    foreach ($room->mealTypes as $key => $mealType) {
                        $data = [
                            'bedType' => $bedType->id,
                            'mealType' => $mealType->id,
                            'childQty' => 0,
                            'bedsQty' => 0,
                        ];
                        if (in_array($mealType->id, json_decode($offerRooms->meal_type_id))) {

                            $typeRate = CustomHelpers::calculateTotalRates($this->isLocal, $rates, $this->checkIn, $this->checkOut, [], 1, $data, $offers, 1);
                            if ($typeRate > 0) {
                                array_push($ratesArr, $typeRate);
                            }
                        }
                    }
                }
            }
        }
        // dd($ratesArr);
        $minRate = count($ratesArr) > 0 ? min($ratesArr) : 0;

        return $minRate;
    }
    public function confirmed($currency)
    {
        $currency = $currency['data']['inputAttributes']['currency'];

        BookingCart::instance('booking')->destroy();
        Session::put('currency', $currency);
        if (Session::has('currency') && Session::get('currency')) {
            $currency = Session::get('currency');
            $property = Property::where(['slug' => $this->slug])->with('currencies')->first();
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
                $secondaryCurrencyname = '';
            }


            if ($currency == $defaultCurrencyname) {
                $this->isLocal = $defaultCurrencyname;
                // dd($this->isLocal);
            } elseif ($currency == $secondaryCurrencyname) {
                $this->isLocal = $secondaryCurrencyname;
            }
           
        } else {
            // $this->isLocal = true;
            $this->isLocal = CustomHelpers::isLocalCountry();
        }
        $this->emitTo('cart.cart-component', 'refreshComponent');
    }
}
