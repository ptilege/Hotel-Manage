<?php

namespace App\Http\Livewire\Property;

use App\Models\Property;
use Livewire\Component;
use Illuminate\Support\Str;

class PropertyGalleryImagesComponent extends Component
{
    public $propertyId;
    public $category = 'all';

    public function mount($propertyId) {
        $this->propertyId = $propertyId;
    }

    public function render()
    {
        $property = Property::with('media')->findOrFail($this->propertyId);
        $allMedia = $property->media()->where('collection_name', Str::slug($property->name));

        $categories = ['all'];
        $images = [];

        foreach ($allMedia->whereJsonDoesntContain('custom_properties', ['category' => 'featured'])->get() as $key => $media) {
            array_push($categories, $media->custom_properties['category']);
        }

        if($this->category == 'all') {
            $images = $allMedia->whereJsonDoesntContain('custom_properties', ['category' => 'featured'])->get()->toArray();
        } else {
            $images = $allMedia->whereJsonContains('custom_properties', ['category' => $this->category])->get()->toArray();
        }
        // dd($images);
        
        $categories = array_unique($categories);

        return view('livewire.property.property-gallery-images-component', ['mediaCategories'=>$categories, 'images'=>$images]);
    }

    public function changeCategory($category) {
        $this->category = $category;
    }
}
