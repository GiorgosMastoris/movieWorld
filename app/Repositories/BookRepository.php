<?php

namespace App\Repositories;

use App\Models\Book;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BookRepository extends BaseRepository
{
    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function getPaginate(array $filter = [], array $relations = ['votes', 'user'], int $perPage = 5): LengthAwarePaginator
    {
        $query = $this->model::with($relations);

        if (!empty($filter['userId'])) {
            $query->where('books.user_id', $filter['userId']);
        }

        if (isset($filter['sortBy']) && ($filter['sortBy'] == 'like' || $filter['sortBy'] == 'hate')) {
            $query->select('books.*', DB::raw('COUNT(book_votes.id) as likes_count'))
                ->groupBy('books.id')
                ->leftJoin('book_votes', function ($join) use ($filter) {
                    $join->on('books.id', '=', 'book_votes.book_id')
                        ->where('book_votes.type', '=', $filter['sortBy']);
                })
                ->orderByDesc('likes_count');
        }

        if (isset($filter['sortBy']) && $filter['sortBy'] == 'date_of_publication') {
            $query->orderBy('date_of_publication', 'desc');
        }

        return $query->paginate($perPage)->withQueryString();
    }

    public function createFromUser(int $userId, array $data): Book
    {
        return $this->model->create([
            'user_id' => $userId,
            'title' => $data['title'],
            'description' => $data['description'],
            'date_of_publication' => $data['date_of_publication'],
        ]);
    }
}
