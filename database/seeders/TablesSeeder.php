<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tables;

class TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for ($i = 1; $i <= 5; $i++) {
            tables::create([
                'type' => 'vip',
                'capacity' => rand(2, 6), // Adjust the capacity range as needed
            ]);
        }

        // Generate VIP tables
        for ($i = 1; $i <= 5; $i++) {
            tables::create([
                'type' => 'regular',
                'capacity' => rand(2, 6), // Adjust the capacity range as needed
            ]);
        }

        // Generate outdoor tables
        for ($i = 1; $i <= 5; $i++) {
            tables::create([
                'type' => 'outdoor',
                'capacity' => rand(2, 6), // Adjust the capacity range as needed
            ]);
        }
    }
}
