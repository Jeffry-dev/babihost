<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Host;
use Illuminate\Database\Seeder;

class HostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch the user with the 'host' role
        $hostUser = User::where('role', 'host')->first();
        if ($hostUser) {
            Host::create([
                'user_id' => $hostUser->id,     
                'bio' => 'Experienced host with a passion for hospitality.',
                'phone_number' => '71245098',
                'national_id' => '123456789',
            ]);
    }
}
}
