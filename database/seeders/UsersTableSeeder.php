<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => bcrypt(env('USER_SEEDER_PASS', 'password')),
                'remember_token' => null,
            ],
            // For testing purpose only
            [
                'id'             => 2,
                'name'           => 'Panitia Pemilwa', 
                'email'          => 'kepanitiaan_pemilwa@pemilwa.com',
                'password'       => bcrypt(env('USER_SEEDER_PASS', 'password')),
                'remember_token' => null,
            ]
        ];

        User::insert($users);
    }
}
