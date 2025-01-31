<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeOrUpdate(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|integer|exists:movies,id',
            'type' => 'required|in:like,hate',
        ]);
        $user = auth()->user();

        $vote = Vote::updateOrCreate(
            [
                'user_id' => $user->id,
                'movie_id' => $validated['movie_id'],
            ],
            [
                'type' => $validated['type'],
            ]
        );

        return back();
    }
}
