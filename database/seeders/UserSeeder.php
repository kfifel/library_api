<?php

namespace Database\Seeders;

use App\Models\User;
use App\Permissions\Role;
use App\Permissions\RolePermissions;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Supper Admin',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole(Role::ADMIN);
        $user->assignRole(Role::RECEPTIONIST);
        $user->assignRole(Role::USER);


        $user = User::create([
            'name' => 'simple user',
            'email' => 'user@library.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole(Role::USER);


        $user = User::create([
            'name' => 'receptionist',
            'email' => 'receptionist@library.com',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole(Role::RECEPTIONIST);
        $user->assignRole(Role::USER);
    }
}
