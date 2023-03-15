<?php

namespace Database\Seeders;

use App\Models\Firearm;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FirearmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Firearm::create([
            'user_id' => 1,
            'make' => 'Club',
            'model' => 'Gun',
            'fac_number' => 0,
        ]);
    }
}
