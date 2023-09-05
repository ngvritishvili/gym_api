<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('calorie_controll')->updateOrInsert(
            [
                'id' => 1
            ], [
            'calories' => 10000,
            'hours_period' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('step_controll')->updateOrInsert(
            [
                'id' => 1
            ],
            [
                'step' => 8000,
                'hours_period' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    }
}
