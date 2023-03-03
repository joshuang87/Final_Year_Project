<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ParkingSpace>
 */
class ParkingSpaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parking_space_id' => fake()->numerify('ABC##'),
            'open_time' => null,
            'close_time' => null,
            'parking_lot_id' => fake()->numerify('G#'),
            'car_plate' => null,
            'client_id' => null
        ];
    }
}
