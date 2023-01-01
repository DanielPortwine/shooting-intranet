<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FirearmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'make' => $this->faker->randomElement(['Beretta', 'Ruger', 'Tippmann', 'Smith & Wesson', 'Glock', 'Colt']),
            'model' => $this->faker->randomElement(['M1911', 'Precision', '10-22', '15-22', '969', '17', '19']),
            'fac_number' => $this->faker->numberBetween(1, 14),
            'serial' => $this->faker->randomKey,
        ];
    }
}
