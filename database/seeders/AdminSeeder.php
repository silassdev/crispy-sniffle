<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'silas@ap.com'],
            [
                'name' => 'Pilars',
                'password' => bcrypt('password123'),
                'is_admin' => true,
            ]
        );
    }
}
