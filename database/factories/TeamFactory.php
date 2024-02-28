<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //['name', 'stadium','numMembers','budget'];
            'name' => $this->faker->name(),
            'stadium' => $this->faker->word(),
            'numMembers' => $this->faker->randomNumber(2, true),
            'budget' => $this->faker->randomFloat(2, 50000,199999),
        ];
    }
}
