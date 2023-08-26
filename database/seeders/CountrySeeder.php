<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Georgia'],
            ['name' => 'USA'],
            ['name' => 'Germany'],
            ['name' => 'Spain'],
            ['name' => 'Ukraine'],
            ['name' => 'Russia'],
            ['name' => 'France'],
            ['name' => 'England'],
            ['name' => 'Portugal'],
            ['name' => 'Poland'],
            ['name' => 'Lithuanian'],
            ['name' => 'Latvia'],
            ['name' => 'Estonia'],
            ['name' => 'Belgium'],
        ];

        Country::upsert(
            $data,
            ['name'],
            ['name']
        );
    }
}
