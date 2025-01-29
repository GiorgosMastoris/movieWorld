<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class MovieController extends Controller
{

    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Movies/Index', [
            'message' => 'Movie world',
        ]);
    }
}
