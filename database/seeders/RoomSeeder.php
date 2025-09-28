<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Property;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch all properties to associate rooms with them
         $properties = Property::all();
         // Create 2 rooms for each property
        foreach ($properties as $property) {
            // Example: create 2 rooms for each property
            Room::create([
                'property_id'=> $property->id,
                'room_type'=> 'Single',
                'capacity' => 1,
                'price_per_night'=> 50.00,
            ]);

            Room::create([
                'property_id' => $property->id,
                'room_type'=> 'Double',
                'capacity' => 2,
                'price_per_night'=> 80.00,
            ]);
    }
}
}
