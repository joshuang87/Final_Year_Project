<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G10'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => '11'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G12'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G13'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G14'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G15'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G16'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G17'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G18'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G19'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G20'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G21'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G22'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G23'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G24'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G25'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G26'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G27'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G28'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G29'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G30'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G31'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G32'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G33'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G34'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G35'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G36'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G37'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G38'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G39'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G40'
        ]);
        \App\Models\ParkingLot::factory()->create([
            'parking_lot_id' => 'G41'
        ]);


        \App\Models\ParkingSpace::factory(50)->create();

    }
}
