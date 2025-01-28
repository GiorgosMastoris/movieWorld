<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create()
    {
        // Return the register page
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
    }
}
