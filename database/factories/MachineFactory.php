<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'machine_name' => fake()->unique()->word(1),
            'category' => fake()->randomElement(['Granulasi', 'Drying', 'Final Mix/camas', 'Cetak', 'Coating', 'Kemas' ,'Mixing', 'Filling', '']),
            'line' => fake()->randomElement(['Line1', 'Line2', 'Line3', 'Line4', 'Line5', 'Line7', 'Line8a', 'Line8b', 'Line10', 'Line11', 'Line12', 'Line13','Line14']),    
        ];
    }
}
