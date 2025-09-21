<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PakarSeeder extends Seeder
{
    public function run()
    {
        $pakars = [
            [
                'name' => 'Dr. Sarah Wijaya, Sp.KK',
                'email' => 'dr.sarah@klinikmarisa.com',
                'password' => Hash::make('pakar123'),
                'role' => 'pakar'
            ],
            [
                'name' => 'Dr. Michael Chen, Sp.KK',
                'email' => 'dr.michael@klinikmarisa.com',
                'password' => Hash::make('pakar123'),
                'role' => 'pakar'
            ],
            [
                'name' => 'Dr. Rina Sari, Sp.KK',
                'email' => 'dr.rina@klinikmarisa.com',
                'password' => Hash::make('pakar123'),
                'role' => 'pakar'
            ],
            [
                'name' => 'Dr. Ahmad Hidayat, Sp.KK',
                'email' => 'dr.ahmad@klinikmarisa.com',
                'password' => Hash::make('pakar123'),
                'role' => 'pakar'
            ],
            [
                'name' => 'Dr. Pakar',
                'email' => 'pakar@klinikmarisa.com',
                'password' => Hash::make('pakar123'),
                'role' => 'pakar'
            ]
        ];

        foreach ($pakars as $pakar) {
            User::create($pakar);
        }

        // Buat user demo untuk testing
        User::create([
            'name' => 'User Demo',
            'email' => 'user@demo.com',
            'password' => Hash::make('user123'),
            'role' => 'pengguna'
        ]);
    }
}
