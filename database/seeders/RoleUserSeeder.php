<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $userRoles = [
            [
                'role_id' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 2,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role_id' => 3,
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        $role_user = DB::table('role_user');
        foreach ($userRoles as $value) {
            $role_user->insert($value);
        }
    }
}
