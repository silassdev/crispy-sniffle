<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'ss@ignis.com'],
            [
                'name' => 'Snr Admin',
                'password' => Hash::make('allpilar'),
                'role' => User::ROLE_ADMIN,
                'approved' => true,
            ]
        );
    }
}
