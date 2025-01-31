<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MovieRepository extends BaseRepository
{
    /**
     * @param Movie $model
     */
    public function __construct(
        Movie $model
    ) {
        parent::__construct($model);
    }

    /**
     * @param array $relations
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getPaginate(array $relations = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model::with($relations)->paginate($perPage);
    }

    /**
     * @param int $userId
     * @param array $data
     * @return Movie
     */
    public function createFromUser(int $userId, array $data): Movie
    {
        return $this->model->create([
            'user_id' => $userId,
            'title' => $data['title'],
            'description' => $data['description'],
            'date_of_publication' => $data['date_of_publication'],
        ]);
    }
}
