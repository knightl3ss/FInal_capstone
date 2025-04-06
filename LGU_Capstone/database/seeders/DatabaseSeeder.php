<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create default admin account
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'middle_name' => '',
            'age' => 30,
            'birthday' => '1994-01-01',
            'status' => 'active',
            'address_street' => '123 Admin Street',
            'address_city' => 'Admin City',
            'address_state' => 'Admin State',
            'address_postal_code' => '12345',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => Hash::make('password123'),
            'phone_number' => '1234567890',
            'gender' => 'male',
            'employee_id' => 'ADMIN001',
            'profile_picture' => 'default-profile.png',
        ]);
    }
}
