<?php

namespace Database\Factories;

use Illuminate\Support\Str;
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
            'parking_space_id' => Str::uuid()->toString(),
            // 'open_time' => null,
            // 'close_time' => null,
            'parking_lot_id' => fake()->numerify('G#'),

            'x' => fake()->numberBetween(0,11),
            'y' => fake()->numberBetween(0,6),
            'i' => fake()->name()
        ];
    }
}
