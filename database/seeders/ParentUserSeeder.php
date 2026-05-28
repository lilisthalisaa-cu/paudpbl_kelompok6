<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ParentUserSeeder extends Seeder
{
    public function run(): void
    {
        $parents = [

            // KELAS B

            [
                'name' => 'YULINA APRILIYA HERLINA NINGSIH',
                'username' => '3204128997',
                'password' => 'Qi@92Lm4',
            ],

            [
                'name' => 'ROSITA PUSPITA JAYANTI',
                'username' => '3193818493',
                'password' => 'Za#74Px1',
            ],

            [
                'name' => 'ANITASARI',
                'username' => '3200018407',
                'password' => 'Mv!28Rt5',
            ],

            [
                'name' => 'MIMIN SETIYOWATI',
                'username' => '3201598994',
                'password' => 'Xp@83Qa7',
            ],

            [
                'name' => 'ANIS SAHABAH',
                'username' => '3197238570',
                'password' => 'Bw#46Ty2',
            ],

            [
                'name' => 'SUNDUSIYAH',
                'username' => '3209765951',
                'password' => 'Ln!57Vc9',
            ],

            [
                'name' => 'LINA ANGGRAYANI',
                'username' => '3191078631',
                'password' => 'Ks@31Df8',
            ],

            [
                'name' => 'PUNGKI RESKI',
                'username' => '3190323309',
                'password' => 'Rq#68Mz4',
            ],

            [
                'name' => 'SRI UTAMI',
                'username' => '3202156382',
                'password' => 'Hy!95Ax3',
            ],

            [
                'name' => 'MIKO WULANDARI',
                'username' => '3195967609',
                'password' => 'Po@42Nk7',
            ],

            [
                'name' => 'IIN AYU WULANDARI',
                'username' => '3188215217',
                'password' => 'Gt#86Lm1',
            ],

            // KELAS A

            [
                'name' => 'SUPINIK',
                'username' => '3221935788',
                'password' => 'Uv!73Qx5',
            ],

            [
                'name' => 'ADE SAERI',
                'username' => '3201951713',
                'password' => 'Xa#91Lp2',
            ],

            [
                'name' => 'SRI INDAYATI',
                'username' => '3201685335',
                'password' => 'Qw@73Mn5',
            ],

            [
                'name' => 'SITI MAHMUDAH',
                'username' => '3201843562',
                'password' => 'Rt!48Ks1',
            ],

            [
                'name' => 'NAMA ORANG TUA BINTANG',
                'username' => '3203081582',
                'password' => 'Vz@82Hy6',
            ],

            [
                'name' => 'MERY ARIYANI',
                'username' => '3209314022',
                'password' => 'Lm#24Qa8',
            ],

            [
                'name' => 'WINDA WULANDARI',
                'username' => '3216578445',
                'password' => 'Ty!67Po3',
            ],

            [
                'name' => 'NOVI RATNA SARI',
                'username' => '3203157366',
                'password' => 'Nk@39Xc7',
            ],

            [
                'name' => 'DAYU SETIYOWATI',
                'username' => '3206571193',
                'password' => 'Hs#51We9',
            ],

            [
                'name' => 'PINGKAN VERONIKA',
                'username' => '3201088066',
                'password' => 'Pd!84Rm2',
            ],

            [
                'name' => 'NURAINI',
                'username' => '3219633450',
                'password' => 'Jx@45Bn6',
            ],

            [
                'name' => 'ROVIKA DURI',
                'username' => '3201742229',
                'password' => 'Uc#72Kt4',
            ],

            [
                'name' => 'SRI NINGSIH',
                'username' => '3213890441',
                'password' => 'Ae!63Wp8',
            ],

        ];

        foreach ($parents as $parent) {

            User::create([
                'name' => $parent['name'],
                'username' => $parent['username'],
                'password' => Hash::make($parent['password']),
                'role' => 'parent',
            ]);

        }
    }
}