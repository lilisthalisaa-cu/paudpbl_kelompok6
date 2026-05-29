<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeacherUserSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = [

            [
                'name' => 'Dinda',
                'username' => 'dindahestym@gmail.com',
                'email' => 'dindahestym@gmail.com',
                'password' => 'Dn@45Hm8',
            ],

            [
                'name' => 'Widi',
                'username' => 'widimailia52@gmail.com',
                'email' => 'widimailia52@gmail.com',
                'password' => 'Wd#82Lp4',
            ],

            [
                'name' => 'Retno',
                'username' => 'oktavianingrumretno@gmail.com',
                'email' => 'oktavianingrumretno@gmail.com',
                'password' => 'Rt!73Qx9',
            ],

            [
                'name' => 'Widyawati, S.Pd',
                'username' => 'widyawati001@admin.paud.belajar.id',
                'email' => 'widyawati001@admin.paud.belajar.id',
                'password' => 'Wy@64Zn2',
            ],

        ];

        foreach ($teachers as $teacher) {

            User::create([
                'name' => $teacher['name'],
                'username' => $teacher['username'],
                'email' => $teacher['email'],
                'password' => Hash::make($teacher['password']),
                'role' => 'teacher',
            ]);

        }
    }
}