<?php

namespace App\Http\Livewire\Home;

use App\Models\Destination;
use App\Models\Property;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;

class BannerSearchComponent extends Component
{
    public $property = "";
    public $checkIn = "";
    public $checkOut = "";

    public function mount()
    {
        // get today and tomorrow dates
        $today = Carbon::now();
        $tomorrow = Carbon::tomorrow();

        // get todat and tomorrow as a date (ex:2023-01-01)
        $today = $today->toDateString();
        $tomorrow = $tomorrow->toDateString();

        // set default checkin and checkout dates
        $this->checkIn = $today;
        $this->checkOut = $tomorrow;
    }

    public function render()
    {
        $properties = Property::orderBy('name')->get(['name', 'id']);
        $destinations = Destination::orderBy('name')->get(['name', 'id']);



        return view('livewire.home.banner-search-component', ['destinations'=>$destinations, 'properties'=>$properties]);
    }

    public function searchProperty(){
        if(str_contains($this->property, 'property')) {
            $id = str_replace('property-','', $this->property);
            $property = Property::findOrFail($id);
            return redirect()->route('property-details',['slug'=>$property->slug, 'check_in'=>$this->checkIn,'check_out'=>$this->checkOut]);
        } else if(str_contains($this->property, 'destination')) {
            $id = str_replace('destination-','', $this->property);
            $property = Destination::findOrFail($id);
         
            return redirect()->route('destination-details',['slug'=>$property->slug, 'check_in'=>$this->checkIn,'check_out'=>$this->checkOut]);
        } else {
            return redirect()->route('all-properties');
        }
        // dd($this);
    }
}
