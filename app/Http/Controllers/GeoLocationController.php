<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Stevebauman\Location\Facades\Location;
 
class GeoLocationController extends Controller
{
    
    public function index(Request $request)
    {
            $ip = $request->ip();
            // $ip = '192.168.2.118';
            $data = Location::get($ip);
            dd($ip);

            // if ($position = Location::get()) {
            //     // Successfully retrieved position.
            //     echo $position->countryName;
            // } else {
            //     // Failed retrieving position.
            // }
            // dd($position);
    }
}
