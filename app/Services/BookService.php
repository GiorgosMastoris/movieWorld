<?php

namespace App\Services;

use App\Dtos\BookDTO;
use App\Repositories\BookRepository;

readonly class BookService
{
    public function __construct(public BookRepository $bookRepository){}

    public function getPaginated($filter)
    {
        $books = $this->bookRepository->getPaginate($filter);
        $bookDTOs = $books->getCollection()->map(function ($book) {
            $votesData = $book->votes->map(function ($vote) {
                return [
                    'user_id' => $vote->user_id,
                    'book_id' => $vote->book_id,
                    'type' => $vote->type,
                ];
            })->toArray();

            return new BookDTO([
                'id' => $book->id,
                'title' => $book->title,
                'description' => $book->description,
                'user' => $book->user,
                'date_of_publication' => $book->date_of_publication,
                'votes' => $votesData,
            ]);
        });

        return $books->setCollection($bookDTOs);
    }
}
