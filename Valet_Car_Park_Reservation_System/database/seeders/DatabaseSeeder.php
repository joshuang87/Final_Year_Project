<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Reserve;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G0'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G1'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G2'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G3'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G4'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G5'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G6'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G7'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G8'
        ]);

        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G9'
        ]);

        \App\Models\ParkingSpace::factory(50)->create();

        Reserve::factory(100)->create();
    }
}
