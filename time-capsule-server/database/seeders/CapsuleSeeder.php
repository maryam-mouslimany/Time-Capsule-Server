<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Capsule;

class CapsuleSeeder extends Seeder
{
    public function run(): void
    {
        $capsules = [

            [
                'user_id' => 6,
                'title' => 'Chasing Dreams',
                'description' => 'A reflection on the pursuit of goals.',
                'message' => "## Never Give Up\n\nPursuing dreams is not easy, but every step forward is worth it.\nStay focused and keep believing.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#FFD0AF',
                'ip_address' => '192.168.1.10',
                'country' => 'Lebanon',
                'reveal_date' => '2025-08-01',
                'tags' => [24, 36, 39], // hopeful, goal, motivation
            ],
            [
                'user_id' => 7,
                'title' => 'Family First',
                'description' => 'Thoughts about family bonds.',
                'message' => "**Family** is where life begins and love never ends.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#C1F4BE',
                'ip_address' => '192.168.1.11',
                'country' => 'Lebanon',
                'reveal_date' => '2025-08-02',
                'tags' => [33, 34], // friendship, family
            ],
            [
                'user_id' => 8,
                'title' => 'The Power of Love',
                'description' => 'Sharing a warm experience.',
                'message' => "### Love conquers fear\n\nEvery act of love is a step toward a better world.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#F4BEBF',
                'ip_address' => '192.168.1.12',
                'country' => 'Jordan',
                'reveal_date' => '2025-08-03',
                'tags' => [27, 31, 32], // love, nostalgic, regret
            ],
            [
                'user_id' => 6,
                'title' => 'Overcoming Failure',
                'description' => 'How I bounced back from setbacks.',
                'message' => "Failure is not the opposite of success; it's part of success.\n\nKeep learning.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#EFF4B0',
                'ip_address' => '10.0.0.2',
                'country' => 'USA',
                'reveal_date' => '2025-08-04',
                'tags' => [23, 37, 38], // sad, success, failure
            ],
            [
                'user_id' => 7,
                'title' => 'The Lonely Road',
                'description' => 'Moments of solitude and growth.',
                'message' => "In loneliness, I found my strength.\nIt taught me to rely on myself.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#CBBEF4',
                'ip_address' => '172.16.0.3',
                'country' => 'France',
                'reveal_date' => '2025-08-05',
                'tags' => [24, 29, 35], // hopeful, lonely, growth
            ],
            [
                'user_id' => 8,
                'title' => 'Hope Never Dies',
                'description' => 'A message of hope.',
                'message' => "Hope is the only thing stronger than fear.\nKeep holding on.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#C4E7FA',
                'ip_address' => '172.16.0.4',
                'country' => 'Germany',
                'reveal_date' => '2025-08-06',
                'tags' => [25, 30, 42], // excited, fearful, memory
            ],
            [
                'user_id' => 6,
                'title' => 'Gratitude Today',
                'description' => 'Little things I’m thankful for.',
                'message' => "Every day brings a new reason to be thankful.\n\nGratitude changes everything.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#FAC4F0',
                'ip_address' => '192.168.2.2',
                'country' => 'Lebanon',
                'reveal_date' => '2025-08-07',
                'tags' => [28, 42], // grateful, memory
            ],
            [
                'user_id' => 7,
                'title' => 'Future Vision',
                'description' => 'Where I see myself.',
                'message' => "The future is not something we enter. It’s something we create.",
                'status' => 'public',
                'surprise_mode' => false,
                'revealed' => true,
                'image_path' => '',
                'audio_path' => '',
                'color' => '#A0E8D4',
                'ip_address' => '10.10.10.10',
                'country' => 'UAE',
                'reveal_date' => '2025-08-08',
                'tags' => [40, 41, 42], // dream, future, memory
            ],


        ];


        foreach ($capsules as $capsuleData) {
            $tags = $capsuleData['tags'];
            unset($capsuleData['tags']); // ⬅️ Remove before create()

            $capsule = Capsule::create($capsuleData);

            if (!empty($tags)) {
                $capsule->tags()->attach($tags);
            }
        }
    }
}
