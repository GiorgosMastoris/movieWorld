<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repositories\AuthRepository;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;

class RegisterController extends Controller
{
    /**
     * @param AuthRepository $authRepository
     */
    public function __construct(public readonly AuthRepository $authRepository){}

    public function create(): \Inertia\Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $this->authRepository->create($request->validated());

        return to_route('login')->with('success', trans('auth.register_success'));
    }
}
