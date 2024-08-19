<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Amenity;
use App\Models\BedType;
use App\Models\Currency;
use App\Models\Destination;
use App\Models\DestinationFeature;
use App\Models\MealType;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Rate;
use App\Models\Room;
use App\Models\Tax;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TempDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert(
            [
                [
                    'name' => 'LKR',
                    'symbol' => 'Rs',
                    'decimal_places' => 2,
                    'symbol_pos' => 'before',
                    'status' => 1
                ],
                [
                    'name' => 'USD',
                    'symbol' => '$',
                    'decimal_places' => 2,
                    'symbol_pos' => 'before',
                    'status' => 1
                ],
                [
                    'name' => 'EURO',
                    'symbol' => '$EURO',
                    'decimal_places' => 2,
                    'symbol_pos' => 'after',
                    'status' => 1
                ],
            ]
        );

        Tax::insert(
            [
                [
                    'name' => 'Tax 1',
                    'value' => '10',
                    'is_amount' => 1,
                    'property_id' => 1,
                    'status' => 1
                ],
                [
                    'name' => 'Tax 2',
                    'value' => '10',
                    'is_amount' => 0,
                    'property_id' => 2,
                    'status' => 1
                ],
                [
                    'name' => 'Tax 3',
                    'value' => '15',
                    'is_amount' => 1,
                    'property_id' => 3,
                    'status' => 0
                ],
            ]
        );

        // store returned data into array of records
        $records = importCsv(public_path("/seeders/amenities.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            Amenity::create([
                'property_id' => 1,
                'name' => $record['name'],
                'icon' => $record['icon'],
                'status' => $record['status'],
            ]);
        }

        // store returned data into array of records
        $records = importCsv(public_path("/seeders/destinations.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            Destination::create([
                'name' => $record['name'],
                'slug' => $record['slug'],
                'meta_id' => 1,
                'description' => $record['description'],
                'status' => $record['status'],
                'is_featured' => $record['featured'],
            ]);
        }
        // store returned data into array of records
        $records = importCsv(public_path("/seeders/property-types.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            PropertyType::create([
                'name' => $record['name'],
                'slug' => $record['slug'],
                'description' => $record['description'],
                'status' => $record['status'],
            ]);
        }
        // store returned data into array of records
        $records = importCsv(public_path("/seeders/properties.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            Property::create([
                'name' => $record['name'],
                'slug' => $record['slug'],
                'description' => $record['description'],
                'property_type_id' => 1,
                'email' => $record['email'],
                'address_1' => $record['address'],
                'destination_id' => 1,
                'country_id' => 1,
                'contact_1' => 1,
                'status' => 1,
            ]);
        }

        DB::table('amenity_property')->insert([
            ['property_id' => 1, 'amenity_id' => 1],
            ['property_id' => 1, 'amenity_id' => 2],
            ['property_id' => 1, 'amenity_id' => 3],
            ['property_id' => 1, 'amenity_id' => 4],
            ['property_id' => 1, 'amenity_id' => 5],
            ['property_id' => 1, 'amenity_id' => 6],
            ['property_id' => 1, 'amenity_id' => 7],
            ['property_id' => 1, 'amenity_id' => 8],
            ['property_id' => 1, 'amenity_id' => 9],
            ['property_id' => 2, 'amenity_id' => 1],
            ['property_id' => 2, 'amenity_id' => 2],
            ['property_id' => 2, 'amenity_id' => 3],
            ['property_id' => 2, 'amenity_id' => 4],
            ['property_id' => 2, 'amenity_id' => 5],
            ['property_id' => 2, 'amenity_id' => 6],
            ['property_id' => 2, 'amenity_id' => 7],
            ['property_id' => 2, 'amenity_id' => 8],
            ['property_id' => 2, 'amenity_id' => 9],
        ]);
        // store returned data into array of records
        $records = importCsv(public_path("/seeders/rooms.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            Room::create([
                'room_no' => $record['room_no'],
                'property_id' => $record['property_id'],
                'name' => $record['name'],
                'description' => $record['description'],
                'max_adults' => $record['max_adults'],
                'max_child' => $record['max_child'],
                'max_extra_beds' => $record['max_extra_beds'],
                'quantity' => $record['quantity'],
                'web_quantity' => $record['web_quantity'],
                'status' => $record['status'],
            ]);
        }
        // store returned data into array of records
        $records = importCsv(public_path("/seeders/activities.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            Activity::create([
                'name' => $record['name'],
                'status' => $record['status'],
            ]);
        }
        // store returned data into array of records
        $records = importCsv(public_path("/seeders/destination-features.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            DestinationFeature::create([
                'name' => $record['name'],
                'status' => $record['status'],
            ]);
        }

        // store returned data into array of records
        $records = importCsv(public_path("/seeders/meal-types.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            MealType::create([
                'name' => $record['name'],
                'description' => $record['description'],
                'status' => 1,
            ]);
        }

        // store returned data into array of records
        $records = importCsv(public_path("/seeders/bed-types.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            BedType::create([
                'name' => $record['name'],
                'status' => 1,
            ]);
        }

        DB::table('meal_type_property')->insert([
            ['meal_type_id' => 1, 'property_id' => 1, 'status' => 1],
            ['meal_type_id' => 2, 'property_id' => 1, 'status' => 1],
            ['meal_type_id' => 3, 'property_id' => 1, 'status' => 1],
            ['meal_type_id' => 1, 'property_id' => 2, 'status' => 1],
            ['meal_type_id' => 2, 'property_id' => 2, 'status' => 1],
            ['meal_type_id' => 3, 'property_id' => 2, 'status' => 1],
        ]);

        DB::table('bed_type_property')->insert([
            ['bed_type_id' => 1, 'property_id' => 1, 'quantity' => 1, 'status' => 1],
            ['bed_type_id' => 2, 'property_id' => 1, 'quantity' => 2, 'status' => 1],
            ['bed_type_id' => 3, 'property_id' => 1, 'quantity' => 3, 'status' => 1],
            ['bed_type_id' => 1, 'property_id' => 2, 'quantity' => 1, 'status' => 1],
            ['bed_type_id' => 2, 'property_id' => 2, 'quantity' => 2, 'status' => 1],
            ['bed_type_id' => 3, 'property_id' => 2, 'quantity' => 3, 'status' => 1],
        ]);

        DB::table('bed_type_room')->insert([
            ['bed_type_id' => 1, 'room_id' => 1],
            ['bed_type_id' => 2, 'room_id' => 1],
            ['bed_type_id' => 3, 'room_id' => 1],
            ['bed_type_id' => 1, 'room_id' => 2],
            ['bed_type_id' => 2, 'room_id' => 2],
            ['bed_type_id' => 3, 'room_id' => 2],
        ]);

        DB::table('meal_type_room')->insert([
            ['meal_type_id' => 1, 'room_id' => 1],
            ['meal_type_id' => 2, 'room_id' => 1],
            ['meal_type_id' => 3, 'room_id' => 1],
            ['meal_type_id' => 1, 'room_id' => 2],
            ['meal_type_id' => 2, 'room_id' => 2],
            ['meal_type_id' => 3, 'room_id' => 2],
        ]);

        // store returned data into array of records
        $records = importCsv(public_path("/seeders/rates.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            Rate::create([
                'property_id' => $record['property_id'],
                'room_id' => $record['room_id'],
                'bed_type_id' => $record['bed_type_id'],
                'meal_type_id' => $record['meal_type_id'],
                'price_per' => $record['price_per'],
                'price' => $record['price'],
                'price_extra_person' => $record['price_extra_person'],
                'price_extra_child' => $record['price_extra_child'],
                'from_date' => $record['from_date'],
                'to_date' => $record['to_date'],
                'is_holiday_rate' => $record['is_holiday_rate'],
                'is_weekend_rate' => $record['is_weekend_rate'],
                'status' => $record['status']
            ]);
        }
    }
}
