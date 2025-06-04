<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use App\Models\BookVote;
use Illuminate\Database\Seeder;

class BookVoteSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $bookIds = Book::inRandomOrder()->take(20)->pluck('id')->toArray();

        $combinations = [];

        foreach ($userIds as $userId) {
            foreach ($bookIds as $bookId) {
                $combinations[] = [
                    'user_id' => $userId,
                    'book_id' => $bookId,
                ];
            }
        }

        shuffle($combinations);

        foreach ($combinations as $combination) {
            BookVote::factory()->create($combination);
        }
    }
}
