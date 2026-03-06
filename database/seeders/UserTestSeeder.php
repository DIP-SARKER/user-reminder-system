<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('password');
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => $password,
            'is_admin' => true,
            'last_login_at' => now()->subDays(1),
        ]);

        User::create([
            'name' => 'Active User',
            'email' => 'active@test.com',
            'password' => $password,
            'last_login_at' => now()->subDays(2),
        ]);

        // Never logged in
        User::create([
            'name' => 'Never Logged In',
            'email' => 'never@test.com',
            'password' => $password,
            'last_login_at' => null,
        ]);

        User::create([
            'name' => 'Threshold User',
            'email' => 'threshold@test.com',
            'password' => $password,
            'last_login_at' => now()->subDays(7),
        ]);
    }
}
