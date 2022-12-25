<?php

namespace Database\Seeders;

use App\Models\Target;
use App\Models\TargetScore;
use App\Models\TargetType;
use App\Models\Visit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Visit::get() as $visit) {
            Target::factory()
                ->times(5)
                ->create([
                    'user_id' => $visit->user->id,
                    'visit_id' => $visit->id,
                ])
                ->each(function ($target) {
                    $targetType = TargetType::with(['scores'])->find($target->type_id);
                    for ($x = 0; $x < 10; $x++) {
                        TargetScore::factory()->create([
                            'target_id' => $target->id,
                            'score_id' => $targetType->scores->pluck('id')->random(),
                        ]);
                    }
                });
        }
    }
}
