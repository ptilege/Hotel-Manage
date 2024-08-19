<?php

namespace App\Http\Livewire\Home;

use App\Models\Offer;
use App\Models\Destination;
use Livewire\Component;

class TopDealsComponent extends Component
{
    public $category  = null;
    public $deals;
    public function render()
    {
        $dealsCities = [];
        $deals = Offer::with('media')->where(['status'=>1, 'is_featured'=>1])->get();
        
        $dealsFilter = clone $deals;
        $this->deals = $dealsFilter;

        if($this->category) {
            $dealsFilter = Offer::with('media')->where(['status'=>1, 'is_featured'=>1])->whereHas('property', function($q){
                $q->where('destination_id', $this->category);
            })->limit(4)->get();
        } else {
            $dealsFilter = Offer::with('media', 'property')->where(['status'=>1, 'is_featured'=>1])->limit(4)->get();
        }
        // dd($dealsFilter);
        // $destinations = Destination::where(['status'=>1, 'is_featured'=>1])->limit(8)->get();

        foreach ($deals as $deal) {
            // Use optional() to handle the case where $deal->property is null
            $d = optional($deal->property)->destination;
            
            // Check if $d is not null before pushing it into the array
            if ($d !== null) {
                array_push($dealsCities, $d);
            }
        }
        $dealsCities = collect($dealsCities)->unique();

        return view('livewire.home.top-deals-component', [
            'deals'=> $dealsFilter,
            'destinations'=>$dealsCities]);
        
    }
    public function changeDeal($id) {
        $this->category = $id;
        $this->dispatchBrowserEvent('contentChanged');
    }
}
