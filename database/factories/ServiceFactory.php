<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'category_name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'duration' => $this->faker->numberBetween(15, 120),
            'status' => $this->faker->randomElement(['pending', 'active', 'inactive']),
        ];
    }
}
