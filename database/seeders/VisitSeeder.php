<?php

namespace Database\Seeders;

use App\Models\Visit;
use App\Models\Target;
use App\Models\TargetScore;
use App\Models\TargetType;
use App\Models\TargetTypeScore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class VisitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visit::factory()->times(10)->create();
    }
}
