<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Career;

class CareersPageComponent extends Component
{
    public $careers;
    public $careerId;

    public function mount()
    {
        $this->careers = Career::where('status', 1)->get();
    }
    public function render()
    {
        $career = Career::where('status', 1)->get();
        // dd($career);
        return view('livewire.careers-page-component', compact('career'))->layout('frontend');
    }
   
   
}
