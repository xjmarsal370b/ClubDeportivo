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
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2021-10-28 08:09:55',
                'verification_token' => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'José Manuel',
                'email'              => 'xjmarsal370b@ieshnosmachado.org',
                'password'           => bcrypt('12345678'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2021-10-28 08:09:55',
                'verification_token' => '',
            ],
            [
                'id'                 => 3,
                'name'               => 'Francisco',
                'email'              => 'frangv1991@gmail.com',
                'password'           => bcrypt('12345678'),
                'remember_token'     => null,
                'approved'           => 1,
                'verified'           => 1,
                'verified_at'        => '2021-10-28 08:09:55',
                'verification_token' => '',
            ],
        ];

        User::insert($users);
    }
}
