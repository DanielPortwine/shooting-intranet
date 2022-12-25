<?php

namespace Database\Factories;

use App\Models\TargetType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TargetTypeScore>
 */
class TargetTypeScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'target_type_id' => TargetType::inRandomOrder()->first()->id,
            'score' => $this->faker->randomDigit(),
        ];
    }
}
