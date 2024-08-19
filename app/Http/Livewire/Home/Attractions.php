<?php
namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Property;
use App\Models\DestinationFeature;

class Attractions extends Component
{
    public $feature;
    public $properties;

    public function mount()
    {
        $this->properties = Property::where('status', 1)->limit(16)->get(); // Load all properties initially
    }

    public function render()
    {
        $features = DestinationFeature::where('status', 1)->get();

        if ($this->feature && $this->feature !== 'null') {
            $selectedFeature = DestinationFeature::findOrFail($this->feature);
            $destinations = $selectedFeature->destinations()
                ->where('status', 1)
                ->limit(16)
                ->pluck('id');

            $this->properties = Property::whereIn('destination_id', $destinations)
                ->where('status', 1)
                ->limit(16)
                ->get();
        } elseif ($this->feature === 'null') {
            // Load all properties when "All Features" is selected
            $this->properties = Property::where('status', 1)->limit(16)->get();
        }

        return view('livewire.home.attractions', [
            'properties' => $this->properties,
            'features' => $features,
            'feature' => $this->feature,
        ]);
    }

    public function changeFeature($id)
    {
        $this->feature = $id;
    }

    public function redirectToProperty($slug)
    {
        // Redirects to the property's page using its slug
        return redirect()->to(route('property-details', ['slug' => $slug]));
    }
}
