<?php

namespace App\Repositories;

use App\Models\Movie;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

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
     * @param array $filter
     * @param array $relations
     * @param int $perPage
     * @return LengthAwarePaginator
     * TODO Need to refactor
     */
    public function getPaginate(array $filter = [], array $relations = ['votes', 'user'], int $perPage = 5): LengthAwarePaginator
    {
        $query = $this->model::with($relations)
            ->with($relations);

        if (!empty($filter['userId'])) {
            $query->where('movies.user_id', $filter['userId']);  // Explicitly specify the table
        }

        if (isset($filter['sortBy']) && ($filter['sortBy'] == 'like' || $filter['sortBy'] == 'hate')) {
            $query->select('movies.*', DB::raw('COUNT(votes.id) as likes_count'))
                ->groupBy('movies.id')
                ->leftJoin('votes', function ($join) use ($filter) {
                    $join->on('movies.id', '=', 'votes.movie_id')
                        ->where('votes.type', '=', $filter['sortBy']);
                })
                ->orderByDesc('likes_count');
        }

        if (isset($filter['sortBy']) && $filter['sortBy'] == 'date_of_publication') {
            $query->orderBy('date_of_publication', 'desc');
        }

        return  $query->paginate($perPage)->withQueryString();
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
