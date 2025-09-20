<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PakarSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'pakar@mail.com'],
            [
                'name' => 'Pakar Sistem',
                'password' => Hash::make('pakar123'),
                'role' => 'pakar'
            ]
        );
    }
}

