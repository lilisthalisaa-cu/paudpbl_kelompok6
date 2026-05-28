<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([

            'name' => 'Admin PAUD',

            'username' => '69818309', // NPSN

            'email' => 'admin@paud.com',

            'password' => Hash::make('Admin@123'),

            'role' => 'admin',

        ]);
    }
}