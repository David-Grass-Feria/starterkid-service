<?php

namespace GrassFeria\StarterkidService\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \GrassFeria\StarterkidService\Models\Service::create([
            'id'                                        => 1,
            
        ]);
    }
}