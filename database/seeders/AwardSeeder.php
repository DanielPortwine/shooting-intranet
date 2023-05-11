<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Host
        $host = Award::create([
            'name' => 'Host',
            'description' => 'Awarded for hosting people on Guest Days.',
            'level' => 0,
            'threshold' => 0,
        ]);
        Award::create([
            'parent_id' => $host->id,
            'name' => 'New Host',
            'description' => 'Bring a guest to the shooting range',
            'level' => 1,
            'threshold' => 1,
        ]);
        Award::create([
            'parent_id' => $host->id,
            'name' => 'Hospitable Host',
            'description' => 'Bring 5 guests to the shooting range',
            'level' => 2,
            'threshold' => 5,
        ]);
        Award::create([
            'parent_id' => $host->id,
            'name' => 'Generous Host',
            'description' => 'Bring 10 guests to the shooting range',
            'level' => 3,
            'threshold' => 10,
        ]);
        Award::create([
            'parent_id' => $host->id,
            'name' => 'Super Host',
            'description' => 'Bring 25 guests to the shooting range',
            'level' => 4,
            'threshold' => 25,
        ]);

        // Visitor
        $visitor = Award::create([
            'name' => 'Visitor',
            'description' => 'Awarded for attending the range.',
            'level' => 0,
            'threshold' => 0,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'First Visit',
            'description' => 'Visit the range for the first time',
            'level' => 1,
            'threshold' => 1,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Frequent Visitor',
            'description' => 'Visit the range five times',
            'level' => 2,
            'threshold' => 5,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Regular Visitor',
            'description' => 'Visit the range ten times',
            'level' => 3,
            'threshold' => 10,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Dedicated Visitor',
            'description' => 'Visit the range twenty five times',
            'level' => 4,
            'threshold' => 25,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Loyal Visitor',
            'description' => 'Visit the range fifty times',
            'level' => 5,
            'threshold' => 50,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Expert Visitor',
            'description' => 'Visit the range one hundred times',
            'level' => 6,
            'threshold' => 100,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Master Visitor',
            'description' => 'Visit the range two hundred and fifty times',
            'level' => 7,
            'threshold' => 250,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Elite Visitor',
            'description' => 'Visit the range five hundred times',
            'level' => 8,
            'threshold' => 500,
        ]);
        Award::create([
            'parent_id' => $visitor->id,
            'name' => 'Legendary Visitor',
            'description' => 'Visit the range one thousand times',
            'level' => 9,
            'threshold' => 1000,
        ]);

        // Second Home
        // track the number of days in a row a user has visited the range
        $secondHome = Award::create([
            'name' => 'Second Home',
            'description' => 'Awarded for visiting the range on consecutive days.',
            'level' => 0,
            'threshold' => 0,
        ]);
        // awards at check-ins 7, 14, 28, 50, 100, 200, 365, 500, 750, 1000
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Weekend Warrior',
            'description' => 'Visit the range on 7 consecutive days',
            'level' => 1,
            'threshold' => 7,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Two Week Streak',
            'description' => 'Visit the range on 14 consecutive days',
            'level' => 2,
            'threshold' => 14,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Month Long Streak',
            'description' => 'Visit the range on 28 consecutive days',
            'level' => 3,
            'threshold' => 28,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Half Century',
            'description' => 'Visit the range on 50 consecutive days',
            'level' => 4,
            'threshold' => 50,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Century',
            'description' => 'Visit the range on 100 consecutive days',
            'level' => 5,
            'threshold' => 100,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Double Century',
            'description' => 'Visit the range on 200 consecutive days',
            'level' => 6,
            'threshold' => 200,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Year Long Streak',
            'description' => 'Visit the range on 365 consecutive days',
            'level' => 7,
            'threshold' => 365,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Half Millenium',
            'description' => 'Visit the range on 500 consecutive days',
            'level' => 8,
            'threshold' => 500,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Three Quarter Millenium',
            'description' => 'Visit the range on 750 consecutive days',
            'level' => 9,
            'threshold' => 750,
        ]);
        Award::create([
            'parent_id' => $secondHome->id,
            'name' => 'Millenium',
            'description' => 'Visit the range on 1000 consecutive days',
            'level' => 10,
            'threshold' => 1000,
        ]);
    }
}
