<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $email = env('INITIAL_ADMIN_EMAIL','shila@ap.com');
        $pass  = env('INITIAL_ADMIN_PASSWORD','ashilatech');

        User::updateOrCreate(
            ['email' => $email],
            [
                'name' => 'Administrator',
                'password' => Hash::make($pass),
                'role' => User::ROLE_ADMIN,
                'approved' => true,
            ]
        );
    }
}
