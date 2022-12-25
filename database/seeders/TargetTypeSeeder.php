<?php

namespace Database\Seeders;

use App\Models\TargetType;
use App\Models\TargetTypeScore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // numeric 10 shots
        $numericType = TargetType::factory()->create([
            'name' => 'Numeric',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '10',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '9',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '8',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '7',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '6',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '5',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '4',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '3',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '2',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '1',
        ]);
    }
}
