<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
         User::create([
            'name' => 'Admin User',
            'email' => 'admin@hotmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Host user
        User::create([
            'name' => 'Host User',
            'email' => 'host@hotmail.com.com',
            'password' => Hash::make('password'),
            'role' => 'host',
        ]);

        // Traveler user
        User::create([
            'name' => 'Traveler User',
            'email' => 'traveler@hotmail.com',
            'password' => Hash::make('password'),
            'role' => 'traveler',
        ]);
    }
}
