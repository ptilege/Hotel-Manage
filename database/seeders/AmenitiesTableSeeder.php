<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;
use App\Models\Property;


class AmenitiesTableSeeder extends Seeder
{
    public function run()
    {
        $propertyIds = Property::pluck('id')->toArray();

        $amenityData = [
            'Airport Shuttle' => 'fas fa-shuttle-van',
            'Alarm' => 'fas fa-clock',
            'Bar' => 'fas fa-wine-glass',
            'Beach' => 'fas fa-umbrella-beach',
            'Breakfast' => 'fas fa-utensil-spoon',
            'Cycles' => 'fas fa-biking',
            'Hot Water' => 'fas fa-hot-tub',
            'Mini-Bar' => 'fas fa-wine-bottle',
        ];

        foreach ($propertyIds as $propertyId) {
            foreach ($amenityData as $name => $icon) {
                Amenity::create([
                    'property_id' => $propertyId,
                    'name' => $name,
                    'icon' => $icon,
                    'status' => 1, // Assuming default status
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}

