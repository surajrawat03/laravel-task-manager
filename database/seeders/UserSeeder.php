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
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'manager',
                'email' => 'manager@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('manager'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'employee',
                'email' => 'employee@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('employee'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
