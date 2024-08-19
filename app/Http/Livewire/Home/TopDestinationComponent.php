<?php

namespace App\Http\Livewire\Home;

use App\Models\Destination;
use Livewire\Component;

class TopDestinationComponent extends Component
{
    public function render()
    {
        $destinations = Destination::where(['status'=>1, 'is_featured'=>1])->limit(16)->get();
        return view('livewire.home.top-destination-component', ['destinations'=>$destinations]);
    }
}
