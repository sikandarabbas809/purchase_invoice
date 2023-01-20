<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryLocation;

class DeliveyLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppiler = [
            [
                "location" => 'Lahore'
               
            ],
            [
                "location" => 'Karachi'
                
            ],
            [
                'location' => 'Islamabad'
                
            ]
        ];
        DeliveryLocation::insert($suppiler);
    }
}
