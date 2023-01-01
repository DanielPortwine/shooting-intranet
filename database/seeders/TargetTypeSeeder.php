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
        // numeric 1-10
        $numericType = TargetType::factory()->create([
            'name' => 'Numeric',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '10',
            'value' => '10',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '9',
            'value' => '9',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '8',
            'value' => '8',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '7',
            'value' => '7',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '6',
            'value' => '6',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '5',
            'value' => '5',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '4',
            'value' => '4',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '3',
            'value' => '3',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '2',
            'value' => '2',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $numericType->id,
            'score' => '1',
            'value' => '1',
        ]);

        // IPSC Minirifle A, C, D, M, NS
        $minirifleType = TargetType::factory()->create([
            'name' => 'Minirifle',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $minirifleType->id,
            'score' => 'A',
            'value' => '5',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $minirifleType->id,
            'score' => 'C',
            'value' => '3',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $minirifleType->id,
            'score' => 'D',
            'value' => '1',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $minirifleType->id,
            'score' => 'M',
            'value' => '-3',
        ]);

        TargetTypeScore::factory()->create([
            'target_type_id' => $minirifleType->id,
            'score' => 'NS',
            'value' => '-5',
        ]);
    }
}
