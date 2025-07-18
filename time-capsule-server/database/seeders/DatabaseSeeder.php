<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Capsule;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        Capsule::factory()->count(5)->create();
    }
}
