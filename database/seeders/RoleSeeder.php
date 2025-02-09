<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = 
        [
            [
            'name' => config('constant.projects.userRole.admin'), 
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
                'name' => config('constant.projects.userRole.manager'), 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => config('constant.projects.userRole.employee'), 
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Role::insert($roles);
    }
}