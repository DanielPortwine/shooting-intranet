<?php

namespace Database\Factories;

use App\Models\Target;
use App\Models\TargetType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TargetScore>
 */
class TargetScoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $target = Target::with(['type', 'type.scores'])->inRandomOrder()->first();
        $targetType = TargetType::find($target->type_id);

        return [
            'target_id' => $target->id,
            'score_id' => $this->faker->randomElement($targetType->scores->pluck('id')),
        ];
    }
}
