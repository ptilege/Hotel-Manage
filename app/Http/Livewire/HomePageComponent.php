<?php

namespace App\Http\Livewire;

use App\Models\Property;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class HomePageComponent extends Component
{
    protected $listeners = [
        'refreshComponent' =>'$refresh',
        
    ];
    public function render()
    {
   
       
    //    dd($currencies);
        // $userIp = request()->ip();
        // $response = Http::get("https://ipinfo.io/{$userIp}/json");
        // $ipInfo = $response->json();
        // $userCountry = $ipInfo['country'] ?? null;
        // $isSriLanka = ($userCountry === 'LK');
        // if($userCountry === 'LK'){
        //     Session::put('currency', 'lkr');
        // }else{
        //     Session::put('currency', 'usd');
        // }
       
        Session::put('currency', 'LKR');
        return view('livewire.home-page-component', [])->layout('frontend');
    }
}
