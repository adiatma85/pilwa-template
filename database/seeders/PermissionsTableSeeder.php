<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'pemilwa_access',
            ],
            [
                'id'    => 18,
                'title' => 'pesertum_create',
            ],
            [
                'id'    => 19,
                'title' => 'pesertum_edit',
            ],
            [
                'id'    => 20,
                'title' => 'pesertum_show',
            ],
            [
                'id'    => 21,
                'title' => 'pesertum_delete',
            ],
            [
                'id'    => 22,
                'title' => 'pesertum_access',
            ],
            [
                'id'    => 23,
                'title' => 'calon_create',
            ],
            [
                'id'    => 24,
                'title' => 'calon_edit',
            ],
            [
                'id'    => 25,
                'title' => 'calon_show',
            ],
            [
                'id'    => 26,
                'title' => 'calon_delete',
            ],
            [
                'id'    => 27,
                'title' => 'calon_access',
            ],
            [
                'id'    => 28,
                'title' => 'paslon_create',
            ],
            [
                'id'    => 29,
                'title' => 'paslon_edit',
            ],
            [
                'id'    => 30,
                'title' => 'paslon_show',
            ],
            [
                'id'    => 31,
                'title' => 'paslon_delete',
            ],
            [
                'id'    => 32,
                'title' => 'paslon_access',
            ],
            [
                'id'    => 33,
                'title' => 'suara_create',
            ],
            [
                'id'    => 34,
                'title' => 'suara_edit',
            ],
            [
                'id'    => 35,
                'title' => 'suara_show',
            ],
            [
                'id'    => 36,
                'title' => 'suara_delete',
            ],
            [
                'id'    => 37,
                'title' => 'suara_access',
            ],
            [
                'id'    => 38,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
