<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reserve>
 */
class ReserveFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reserve_id' => Str::uuid()->toString(),
            'price' => rand(20,100),
            'phone_number' => fake()->numerify('###########'),
            'car_plate' => fake()->country(),
            'client_id' => Str::uuid()->toString(),
            'day_of_week' => fake()->dayOfWeek() 
        ];
    }
}
