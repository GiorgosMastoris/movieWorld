<?php

namespace App\Repositories;

use App\Models\BookVote;

class BookVoteRepository extends BaseRepository
{
    public function __construct(BookVote $model)
    {
        parent::__construct($model);
    }

    public function updateOrCreate(int $user_id, int $book_id, $type): mixed
    {
        return $this->model::updateOrCreate(
            [
                'user_id' => $user_id,
                'book_id' => $book_id,
            ],
            [
                'type' => $type,
            ]
        );
    }
}
