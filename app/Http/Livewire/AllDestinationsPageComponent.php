<?php

namespace App\Http\Livewire;

use App\Models\Destination;
use App\Models\DestinationFeature;
use Livewire\Component;

class AllDestinationsPageComponent extends Component
{
    public $feature;
    public function render()
    {
        $destinationFeatures = DestinationFeature::where(['status'=>1])->get();
        if($this->feature) {
            $destinations = Destination::whereHas('destinationFeatures', function($q) {
                $q->where(['destination_features.id'=>$this->feature]);
            })->where(['status'=>1])->get();
        } else {
            $destinations = Destination::where(['status'=>1])->get();
        }
        return view('livewire.all-destinations-page-component',compact('destinationFeatures', 'destinations'))->layout('frontend');
    }

    public function setFeature($id) {
        $this->feature = $id;
    }
   
}
