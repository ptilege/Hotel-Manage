<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Career;
use Illuminate\Support\Facades\Log;

class CareersFormPageComponent extends Component
{
    public $careerId = null;
    public $career;

    protected $listeners = ['careerSelected'];

    public function careerSelected($selectedCareerId)
    {
        $this->careerId = $selectedCareerId;
    }

    public function mount()
    {
        $this->career = Career::find($this->careerId);
    }

    public function render()
    {
        // Log::info($this->careerId);
        $careers = Career::find($this->careerId);
       
    
        $this->career = $careers;
        // dd($this->career);
        return view('livewire.careers-form-page-component')->layout('frontend');
    }
}
