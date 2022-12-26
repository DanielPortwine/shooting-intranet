<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::factory()->withPersonalTeam()->create([
            'name' => 'Super Admin',
            'email' => config('app.super_admin_email'),
        ]);

        $superAdmin->assignRole('Super Admin');

        User::factory()->times(50)->create()->each(function ($user) {
            $user->assignRole('Member');
        });
    }
}
