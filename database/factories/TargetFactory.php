<?php

namespace Database\Factories;

use App\Models\Visit;
use App\Models\TargetType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Target>
 */
class TargetFactory extends Factory
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
            'visit_id' => Visit::inRandomOrder()->first()->id,
            'type_id' => TargetType::inRandomOrder()->first()->id,
            'description' => $this->faker->sentence,
        ];
    }
}
