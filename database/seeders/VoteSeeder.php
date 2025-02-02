<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $movieIds = Movie::inRandomOrder()->take(20)->pluck('id')->toArray();

        $combinations = [];

        foreach ($userIds as $userId) {
            foreach ($movieIds as $movieId) {
                $combinations[] = [
                    'user_id' => $userId,
                    'movie_id' => $movieId,
                ];
            }
        }

        shuffle($combinations);

        foreach ($combinations as $combination) {
            Vote::factory()->create($combination);
        }
    }
}
