<?php

namespace App\Http\Livewire;

use App\Http\CustomHelpers;
use App\Models\Destination;
use App\Models\Property;
use App\Models\Offer;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Livewire\Component;
use App\Models\Review;

class DestinationDetailsComponent extends Component
{
    public $slug;

    public $checkIn;
    public $checkOut;

    public $isLocal;


    public function mount($slug)
    {
        $this->slug = $slug;

        // get today and tomorrow dates
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();

        // get todat and tomorrow as a date (ex:2023-01-01)
        $today = $today->toDateString();
        $tomorrow = $tomorrow->toDateString();

        // set checkin and checkout dates

        $this->checkIn =  $checkIn ?? $today;
        $this->checkOut =  $checkOut ?? $tomorrow;

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
    public function render()
    {
        $destination = Destination::where(['slug' => $this->slug])->first();
        $propeties = Property::where(['status' => 1, 'destination_id'=>$destination->id])->limit(10)->get();
        // dd($destination->image );
        if (!empty($this->selectedStars)) {
            $propeties->whereIn('stars', $this->selectedStars);
        }
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
        // dd($propeties);
        return view('livewire.destination-details-component', compact('destination', 'propeties'))->layout('frontend');
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

    public function displayCurrency($amount)
    {
        $currency = $this->isLocal ? 'Rs' : 'USD';
        $amount = number_format($amount, 2, '.', ',');
        return $currency . ' ' . $amount;
    }
    public function changeCurrency($currency)
    {
        Session::put('currency', $currency);
        if (Session::has('currency') && Session::get('currency')) {
            $currency = Session::get('currency');
            if ($currency == 'usd') {
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
