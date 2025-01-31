<?php

namespace App\Http\Controllers;

use App\Http\Requests\MovieRequest;
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
     * @return Response
     */
    public function index(): Response
    {
        try {
            $movieDTOs = $this->movieService->getPaginated();

            return Inertia::render('Movies/Index', [
                'movies' => $movieDTOs,
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
     * @param MovieRequest $request
     * @return RedirectResponse|Response
     */
    public function store(MovieRequest $request): Response|RedirectResponse
    {
        try {
            $this->movieRepository->createFromUser(Auth::id(), $request->all());
            return to_route('index');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }
}
