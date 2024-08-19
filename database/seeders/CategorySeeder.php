<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                // store returned data into array of records
                $records = importCsv(public_path("/seeders/categories.csv"));

                // add each record to the posts table in DB       
                foreach ($records as $key => $record) {
                    Category::create([
                        'name' => $record['name'],
                        'slug' => $record['slug'],
                        'icon' => $record['icon'],
                        'bg_image' => $record['bg_image'],
                        'title' => $record['title'],
                        'subtitle' => $record['subtitle'],
                        'form_title' => $record['form_title'],
                        'level' => $record['level'],
                        'parent_id' => $record['parent_id'] !=''? $record['parent_id'] :null,
                        'is_featured' => $record['is_featured'],
                        'status' => $record['status'],
                    ]);
                }
    }
}
