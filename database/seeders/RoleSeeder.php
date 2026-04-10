<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin Pet Clinic',
            'email' => 'admin@petclinic.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Doctor
        User::create([
            'name' => 'Dr. Hewan',
            'email' => 'doctor@petclinic.com',
            'password' => Hash::make('password'),
            'role' => 'doctor',
        ]);
    }
}
