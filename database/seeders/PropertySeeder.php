<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Host;        


class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all hosts to associate properties with them
            $hosts = Host::all();
        foreach ($hosts as $host) {
            Property::create([
                'host_id'=> $host->id,
                'title'=> 'Cozy Apartment in Beirut',
                'description'=> 'A beautiful property with modern amenities',
                'address'=> 'Beirut Street',
                'country'=> 'Lebanon',
                'city'=> 'Beirut',
                'postal_code'=> '1001',
                'property_type'=> 'apartment',
            ]);
    }
}
}
