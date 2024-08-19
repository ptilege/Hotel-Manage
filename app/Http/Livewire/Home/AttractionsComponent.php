<?php
namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Destination;
use App\Models\Activity;
use App\Models\DestinationFeature;
use App\Models\Property;

class AttractionsComponent extends Component
{
    public $category = null;

    // public function mount()
    // {
    //     $this->properties = Property::where('status', 1)->limit(16)->get(); // Load all properties initially
    // }

    public function render()
    {
        // $activities = Activity::where('status', 1)->get();

        $features = DestinationFeature::where('status', 1)->get();
        if ($this->category) {
            $selectedFeature = DestinationFeature::findOrFail($this->category);
            $destinations = $selectedFeature->destinations()
                ->where(['status' => 1, 'is_featured' => 1])
                ->limit(16)
                ->pluck('id');

            $properties = Property::whereIn('destination_id', $destinations)
                ->where('status', 1)
                ->limit(16)
                ->get();
        } else {
            // Load all properties when "All Properties" is selected
            $properties = Property::where('status', 1)->limit(4)->get();
        }

        return view('livewire.home.attractions-component', [
            'properties' => $properties,
            'activities' => $features,
        ]);
    }
    public function changeDeal($id)
    {
        $this->category = $id;
    }
}
