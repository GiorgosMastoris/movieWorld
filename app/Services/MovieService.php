<?php

namespace App\Services;

use App\Dtos\MovieDTO;
use App\Repositories\MovieRepository;

readonly class MovieService
{
    public function __construct(public MovieRepository $movieRepository){}
    public function getPaginated($filter){
        $movies = $this->movieRepository->getPaginate($filter);
        $movieDTOs = $movies->getCollection()->map(function ($movie) {
            $votesData = $movie->votes->map(function ($vote) {
                return [
                    'user_id' => $vote->user_id,
                    'movie_id' => $vote->movie_id,
                    'type' => $vote->type,
                ];
            })->toArray();

            return new MovieDTO([
                'id' => $movie->id,
                'title' => $movie->title,
                'description' => $movie->description,
                'user' => $movie->user,
                'date_of_publication' => $movie->date_of_publication,
                'votes' => $votesData,
            ]);
        });

        return $movies->setCollection($movieDTOs);

    }
}
