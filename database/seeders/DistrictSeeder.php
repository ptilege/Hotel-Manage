<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // store returned data into array of records
        $records = importCsv(public_path("/seeders/districts.csv"));

        // add each record to the posts table in DB       
        foreach ($records as $key => $record) {
            District::create([
                'id' => $record['id'],
                'country_id' => $record['country_id'],
                'name' => $record['name'],
                'status' => $record['status'],
            ]);
        }
    }
}
