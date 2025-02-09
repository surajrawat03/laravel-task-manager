<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'status' => config('constant.projects.userStatus.active'),
                'role_id' => 1,
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'status' => config('constant.projects.userStatus.active'),
                'role_id' => 2,
                'email_verified_at' => now(),
                'password' => Hash::make('manager'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'employee',
                'email' => 'employee@gmail.com',
                'status' => config('constant.projects.userStatus.active'),
                'role_id' => 3,
                'email_verified_at' => now(),
                'password' => Hash::make('employee'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        User::insert($users);
    }
}
