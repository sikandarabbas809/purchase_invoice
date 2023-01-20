<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
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
                "name" => 'HR Enterprises'
               
            ],
            [
                "name" => 'Golden Enterprises'
                
            ],
            [
                'name' => 'Tawakal Enterprises'
                
            ]
        ];
        Supplier::insert($suppiler);
    }
}
