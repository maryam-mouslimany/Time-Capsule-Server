<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\models\Capsule;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CapsuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => 0,
            "title" => $this->faker->unique()->words(3, true),
            "description" => $this->faker->sentence(2),
            'message' => $this->faker->paragraph,
            'ip_address' => $this->faker->ipv4,
            'country' => $this->faker->country,
            "status" => 'private',
            'reveal_date' => $this->faker->dateTimeBetween('+1 day', '+5 year')->format('Y-m-d'),
            "revealed" => false,
            "surprise_mode" => false,
            "color" => $this->faker->hexColor,
        ];
    }
}
