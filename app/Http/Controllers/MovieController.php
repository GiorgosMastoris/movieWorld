<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieFilterRequest;
use App\Http\Requests\MovieStoreRequest;
use App\Repositories\MovieRepository;
use App\Services\MovieService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Mockery\Exception;

class MovieController extends Controller
{

    /**
     * @param MovieRepository $movieRepository
     * @param MovieService $movieService
     */
    public function __construct(public readonly MovieRepository $movieRepository, public readonly MovieService $movieService){}

    /**
     * @param MovieFilterRequest $request
     * @return Response
     */
    public function index(MovieFilterRequest $request): Response
    {

        try {
            $filter = $request->validated();
            $movieDTOs = $this->movieService->getPaginated($filter);
            return Inertia::render('Movies/Index', [
                'movies' => $movieDTOs,
                'filters' => $filter
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        try {
            return Inertia::render('Movies/Create');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }

    /**
     * @param MovieStoreRequest $request
     * @return RedirectResponse|Response
     */
    public function store(MovieStoreRequest $request): Response|RedirectResponse
    {
        try {
            $this->movieRepository->createFromUser(Auth::id(), $request->all());
            return to_route('index')->with(['success' => trans('movie.created')]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }
}
