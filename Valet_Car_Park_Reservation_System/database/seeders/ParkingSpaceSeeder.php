<?php

namespace Database\Seeders;

use App\Models\ParkingSpace;
use Illuminate\Database\Seeder;

class ParkingSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ParkingSpace::factory(20)->create();
    }
}
