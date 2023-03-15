<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Package::create([
            'name' => 'Full Membership',
            'price' => 150,
            'recurring' => 'annually',
            'recurring_start_date' => '2022-04-01',
            'pro_rata' => true,
            'charge_full_first' => true,
        ]);

        Package::create([
            'name' => 'Junior Membership',
            'price' => 100,
            'recurring' => 'annually',
            'recurring_start_date' => '2022-04-01',
            'pro_rata' => true,
            'charge_full_first' => true,
        ]);
    }
}
