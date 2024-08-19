<?php

namespace App\Http;

use App\Models\Offer;
use DateTime;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class CustomHelpers
{

    public static function getHolidaysBetweenDates($fromDate, $toDate, $holidays)
    {
        // Convert the start and end dates to DateTime objects
        $start = new DateTime($fromDate);
        $end = new DateTime($toDate);

        // Create an empty array to store the holidays between dates
        $holidaysBetweenDates = [];
        // Loop through each day between the start and end dates
        $currentDate = clone $start;
        while ($currentDate <= $end) {
            // Check if the current date is a holiday
            $isoDate = $currentDate->format('Y-m-d');
            if (in_array($isoDate, $holidays)) {
                $holidaysBetweenDates[] = $isoDate;
            }

            // Move to the next day
            $currentDate->modify('+1 day');
        }

        return $holidaysBetweenDates;
    }

    public static function calculateHolidayNights($fromDate, $toDate, $holidays)
    {
        $noOfNights = 0;
        $start = new DateTime($fromDate);
        $end = new DateTime($toDate);

        $holidays = self::getHolidaysBetweenDates($fromDate, $toDate, $holidays);
        // Loop through each day between the start and end dates
        $currentDate = clone $start;
        while ($currentDate <= $end) {
            // Check if the current date is a holiday
            $isoDate = $currentDate->format('Y-m-d');
            if (in_array($isoDate, $holidays)) {
                $noOfNights++;
            }

            // Move to the next day
            $currentDate->modify('+1 day');
        }

        return $noOfNights;
    }

    public static function calculateWeekendNights($fromDate, $toDate)
    {
        $noOfNights = 0;
        $start = new DateTime($fromDate);
        $end = new DateTime($toDate);

        // Loop through each day between the start and end dates
        $currentDate = clone $start;
        while ($currentDate <= $end) {
            // Check if the current date is a weekend day
            $dayOfWeek = $currentDate->format('w');
            if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                $noOfNights++;
            }

            // Move to the next day
            $currentDate->modify('+1 day');
        }

        return $noOfNights;
    }

    public static function calculateTotalRates($isLocal, $rates, $fromDate, $toDate, $holidays, $nights, $data, $offers=null, $offerType = 1)
    {
        $totalRate = 0;
        $childRate = 0;
        $extraBedRate = 0;
        $normalPrice = 0;

        $baseRate = clone $rates;
        $normalRates = clone $rates;

        $tOffers = $offers ? clone $offers : null;

        $baseRate = $baseRate->where('from_date', '<=', $fromDate)->where('to_date', '>=', $toDate)->where(['type' => 'base'])->first();

        if ($baseRate) {
            $normalRate = $normalRates->where(['base_rate_id' => $baseRate->id, 'bed_type_id' => $data['bedType'], 'meal_type_id' => $data['mealType']])->first();
        } else {
            $normalRate = null;
        }

        // set base rate if available
        if ($isLocal == "LKR") {
            // dd($normalRate->price);
            $totalRate = $baseRate ? $baseRate->price : 0;
            $childRate = $baseRate ? $baseRate->price_extra_child : 0;
            $extraBedRate = $baseRate ? $baseRate->price_extra_person : 0;
            $normalPrice =$normalRate?$normalRate->price:0;
        } elseif($isLocal == "USD") {
            $totalRate = $baseRate ? $baseRate->foreign_price : 0;
            $childRate = $baseRate ? $baseRate->foreign_price_extra_person : 0;
            $extraBedRate = $baseRate ? $baseRate->foreign_price_extra_child : 0;
            $normalPrice = $normalRate?$normalRate->foreign_price:0;
        }

        if($offers) {
            $offerAmount = 0;
            $offer = $tOffers->where('from_date', '<=', $fromDate)->where('to_date', '>=', $toDate)->where(['type' => $offerType])->whereJsonContains('meal_type_id', "{$data['mealType']}")->whereJsonContains('bed_type_id', "{$data['bedType']}");

            switch ($offerType) {
                case 1:
                    $offerAmount = self::calculateDiscountedOffer($offer, $totalRate, $isLocal);
                    break;
                    
                    default:
                    $offerAmount = 0;
                    break;
                }
                $totalRate = $offerAmount;
        }
        

        if ($normalRate) {
            if ($isLocal == "LKR") {
                if ($normalRate->price_per == 'add_amount') {
                    $totalRate = $totalRate + $normalPrice;
                } else if ($normalRate->price_per == 'add_percentage') {
                    $totalRate = $totalRate + ($totalRate * ($normalPrice / 100));
                } else if ($normalRate->price_per == 'reduce_amount') {
                    $totalRate = $totalRate - $normalPrice;
                } else if ($normalRate->price_per == 'reduce_percentage') {
                    $totalRate = $totalRate - ($totalRate * ($normalPrice / 100));
                }
                
            } elseif($isLocal == "USD") {
                if ($normalRate->price_per_foreign == 'add_amount') {
                    $totalRate = $totalRate + $normalPrice;
                } else if ($normalRate->price_per_foreign == 'add_percentage') {
                    $totalRate = $totalRate + ($totalRate * ($normalPrice / 100));
                } else if ($normalRate->price_per_foreign == 'reduce_amount') {
                    $totalRate = $totalRate - $normalPrice;
                } else if ($normalRate->price_per_foreign == 'reduce_percentage') {
                    $totalRate = $totalRate - ($totalRate * ($normalPrice / 100));
                }
            }
        }

        $childRate = $childRate * $data['childQty'];
        $extraBedRate = $extraBedRate * $data['bedsQty'];

        $totalRate = $totalRate + $childRate + $extraBedRate;

        $totalRate = $totalRate * $nights;

        return $totalRate;
    }

    public static function calculateDiscountedOffer($offer, $totalRate, $isLocal) {
        $amount = 0;
        $rate = (float)$totalRate;


        $tOffer = $offer->first();
        if($tOffer) {
            // dd($tOffer);
            
            if ($isLocal == "LKR") {
                $amount = $tOffer ? $tOffer->local_price : 0;

                if ($tOffer->rate_type == 'add_amount') {
                    $amount = $rate + $amount;
                } else if ($tOffer->rate_type == 'add_percentage') {
                    $amount =  $rate + ($rate * ($amount / 100));
                } else if ($tOffer->rate_type == 'reduce_amount') {
                    $amount = $rate - $amount;
                } else if ($tOffer->rate_type == 'reduce_percentage') {
                    $amount =  $rate - ($rate * ($amount / 100));
                }
            } elseif($isLocal == "USD") {
                $amount = $tOffer ? $tOffer->foreign_price : 0;

                if ($tOffer->rate_type == 'add_amount') {
                    $amount = $rate + $amount;
                } else if ($tOffer->rate_type == 'add_percentage') {
                    $amount =  $rate + ($rate * ($amount / 100));
                } else if ($tOffer->rate_type == 'reduce_amount') {
                    $amount = $rate - $amount;
                } else if ($tOffer->rate_type == 'reduce_percentage') {
                    $amount =  $rate - ($rate * ($amount / 100));
                }
            }
        }

        return $amount;
    }

    public static function isLocalCountry()
    {
        try {
            $ip = app()->environment(['production']) ?request()->ip() : '113.59.192.0';
            // $ip = app()->environment(['production']) ? request()->ip() : '101.2.0.0';
            $response = Http::get('http://ip-api.com/json/' . $ip);
            if ($response->ok()) {
                $body = $response->body();
                $body = json_decode($body);
                // dd($body);
                if ($body->status == 'success') {
                    // if ($body->countryCode == 'LK') {
                    if ('LK' == 'LK') {
                        Session::put('COUNTRY_LOCAL', true);
                        return true;
                    } else {
                        Session::put('COUNTRY_LOCAL', false);
                        return false;
                    }
                } else {
                    Session::put('COUNTRY_LOCAL', false);
                    return false;
                }
            } else {
                Session::put('COUNTRY_LOCAL', false);
                return false;
            }
        } catch (\Exception $e) {
            Log::error($e);
            Session::put('COUNTRY_LOCAL', false);
            return false;
        }
    }
}
