<?php

namespace App\Http\Livewire\Home;

use App\Models\Property;
use App\Models\PropertyType;
use Livewire\Component;

class PropertyCategoryComponent extends Component
{
    public function render()
    {
        $propertyTypes = PropertyType::where(['status'=>1])->get();
        $properties = Property::where(['status'=>1])->get();

        return view('livewire.home.property-category-component', ['propertyTypes'=>$propertyTypes, 'properties'=>$properties]);
    }
}
