<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookVoteRequest;
use App\Repositories\BookVoteRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Mockery\Exception;

class BookVotesController extends Controller
{
    public function __construct(public readonly BookVoteRepository $voteRepository){}

    public function storeOrUpdate(BookVoteRequest $request): Response|RedirectResponse
    {
        try {
            $validated = $request->validated();
            $user = auth()->user();
            $this->voteRepository->updateOrCreate($user->id, $validated['book_id'], $validated['type']);
            return back();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }
}
