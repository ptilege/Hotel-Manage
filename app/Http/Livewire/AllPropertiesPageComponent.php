<?php

namespace App\Http\Livewire;

use App\Http\CustomHelpers;
use App\Models\Amenity;
use App\Models\Destination;
use App\Models\Offer;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Rate;
use App\Models\Review;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Livewire\WithPagination;
use BookingCart;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class AllPropertiesPageComponent extends Component
{

    use WithPagination;
    use LivewireAlert;
    public $checkIn;
    public $checkOut;
    public $noOfNights = 1;

    // set pagination theme to bootstrap (default tailwind)
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refreshComponent' =>'$refresh', 'confirmed'];
    public $searchTerm = "";
    public $destination = "";
    public $selectedAmenities = [];
    public $selectedStars = [];
    public $offer = "";
    public $selectedPropertyTypes = [];
    public $type = "";
    public $d_id = "";

    public $isLocal = "LKR";

    protected $queryString = ['d_id'=>['except' => '']];

    public function mount($slug = null)
    {
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

        $category = PropertyType::where(['slug' => $slug])->first();
        if ($category) {
            $this->type = $category->id;
        }

        if($this->d_id) {
            $this->destination = $this->d_id;
        }
        
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
        $this->emit('scrollToTop');
        // dd($this->d_id);
    }

    public function render()
    {
        $propeties = Property::where(['status' => 1]);
        $amenities = Amenity::where(['status' => 1]);
        // $this->getLowestRate(1);
        // filter by name
        if (!empty($this->searchTerm)) {
            $propeties->where('name', 'like', "%" . $this->searchTerm . "%");
        }
        // filter by destination
        if (!empty($this->destination)) {
            $propeties->where('destination_id', $this->destination);
        }
        // filter by type
        if (!empty($this->selectedPropertyTypes)) {
            $propeties->whereIn('property_type_id', $this->selectedPropertyTypes);
        }
        // if(!empty($this->price)){
        //     $minValue = $this->price['min']; 
        //     $maxValue = $this->price['max'];
        //     echo "<script>console.log('Min Value: $minValue, Max Value: $maxValue');</script>";
        // }
        if (!empty($this->selectedAmenities)) {
            $propeties->where(function($query) {
                foreach ($this->selectedAmenities as $amenity) {
                    $query->WhereHas('amenities', function($subQuery) use ($amenity) {
                        $subQuery->where('name', $amenity);
                    });
                }
            });
        }
        if (!empty($this->selectedStars)) {
            // dd($this->selectedStars);
            $propeties->whereIn('stars', $this->selectedStars);
        }
        if(!empty($this->offer)){
            $propeties->where('id', $this->offer);
        }
        // add paginate to records
        $propeties = $propeties->with('featuredMedia')->paginate(15);

        $reviews = Review::whereIn('property_id', $propeties->pluck('id'))->get();
        
        $propertyReviews = $reviews->groupBy('property_id')->map(function ($reviews) {
            $averageReviews = $reviews->avg('comfort') +
                              $reviews->avg('facilities') +
                              $reviews->avg('cleanliness') +
                              $reviews->avg('valueformoney') +
                              $reviews->avg('location') +
                              $reviews->avg('staff');
        
            $averageReviews /= 6; // Divide by the number of criteria (6 in this case)
        
            return [
                'average_reviews' => round($averageReviews, 1),
                'review_count' => $reviews->count(),
            ];
        });
       
        $propeties->each(function ($property) use ($propertyReviews) {
            $propertyData = $propertyReviews->get($property->id, [
                'average_reviews' => 0,
                'review_count' => 0,
            ]);
        
            $property->average_reviews = $propertyData['average_reviews'];
            $property->review_count = $propertyData['review_count'];
        });
        // $property->minRate = 
        // dd($propeties);
        $this->emit('scrollToTop');
        $destinations = Destination::where(['status' => 1])->get();
        $propertTypes = PropertyType::where(['status' => 1])->get();
        $offers = Offer::where(['status' => 1])->get();
        $amenities = Amenity::where(['status' => 1])->get();
        return view('livewire.all-properties-page-component', compact('propeties', 'destinations', 'propertTypes', 'amenities','offers'))->layout('frontend');
    }

 
    public function updated()
    {
        // dd("ffff");
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

    // public function searchProperty(){
    //         $property = Property::where(['name'=>$]);
    //         return redirect()->route('property-details',['slug'=>$property->slug, 'check_in'=>$this->checkIn,'check_out'=>$this->checkOut]);
    // }

    public function displayCurrency($amount) {

        if($this->isLocal == 'LKR'){
           
            $amount = number_format($amount, 0, '.', ',');
            return "LKR" . ' ' . $amount;
        }else{

            $amount = number_format($amount, 0, '.', ',');
            return "USD" . ' ' . $amount;
        }
      
    }

    public function changeCurrency($currency) {
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
                'inputAttributes'=>[
                    'currency'=>$currency,
                   
                ]
            ]);
        }else{
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
    public function confirmed($currency)
    {
        $currency = $currency['data']['inputAttributes']['currency'];
       
        BookingCart::instance('booking')->destroy();
        Session::put('currency', $currency);
        if (Session::has('currency') && Session::get('currency')) {
            $currency = Session::get('currency');
            if ($currency == 'USD') {
                $this->isLocal = 'USD';
            } elseif($currency == 'LKR') {
                $this->isLocal = 'LKR';
            }
        } else {
            // $this->isLocal = true;
            $this->isLocal = CustomHelpers::isLocalCountry();
        }
        $this->emitTo('cart.cart-component', 'refreshComponent'); 
     
    }
}
