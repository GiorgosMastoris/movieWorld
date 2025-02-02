<?php

namespace App\Repositories;

use App\Models\Vote;

class VoteRepository extends BaseRepository
{
    /**
     * @param Vote $model
     */
    public function __construct(
        Vote $model
    ) {
        parent::__construct($model);
    }


    /**
     * @param int $user_id
     * @param int $movie_id
     * @param $type
     * @return mixed
     */
    public function updateOrCreate(int $user_id, int $movie_id, $type ): mixed
    {
        return $this->model::updateOrCreate(
            [
                'user_id' => $user_id,
                'movie_id' => $movie_id,
            ],
            [
                'type' => $type,
            ]
        );
    }
}
