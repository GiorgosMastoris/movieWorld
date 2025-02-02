<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\Models\Vote;
use App\Repositories\VoteRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Mockery\Exception;

class VotesController extends Controller
{

    public function __construct(public readonly VoteRepository $voteRepository){}

    /**
     * @param VoteRequest $request
     * @return RedirectResponse|Response
     */
    public function storeOrUpdate(VoteRequest $request): Response|RedirectResponse
    {
        try {
            $validated = $request->validated();
            $user = auth()->user();
            $this->voteRepository->updateOrCreate($user->id, $validated['movie_id'], $validated['type']);
            return back();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }
}
