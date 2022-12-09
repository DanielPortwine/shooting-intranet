<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'Super Admin']);

        $admin = Role::create(['name' => 'Admin']);
        $admin->givePermissionTo('access-admin');
        $admin->givePermissionTo('access-app');

        $member = Role::create(['name' => 'Member']);
        $member->givePermissionTo('access-app');
    }
}
