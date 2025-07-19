<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    
    public function run(): void
    {
        $tags = [
            'happy',
            'sad',
            'hopeful',
            'excited',
            'angry',
            'love',
            'grateful',
            'lonely',
            'fearful',
            'nostalgic',
            'regret',
            'friendship',
            'family',
            'growth',
            'goal',
            'success',
            'failure',
            'motivation',
            'dream',
            'future',
            'memory',
        ];

        foreach ($tags as $tag) {
            DB::table('tags')->insert([
                'name' => $tag,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
    }

