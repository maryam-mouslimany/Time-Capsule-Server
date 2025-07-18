<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use app\models\Capsule;

class CapsuleSeeder extends Seeder
{
    
    public function run(): void
    {
        Capsule::factory()->count(10)->create();
    }
}
