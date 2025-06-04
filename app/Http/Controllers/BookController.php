<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFilterRequest;
use App\Http\Requests\BookStoreRequest;
use App\Repositories\BookRepository;
use App\Services\BookService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;
use Mockery\Exception;

class BookController extends Controller
{
    public function __construct(public readonly BookRepository $bookRepository, public readonly BookService $bookService){}

    public function index(BookFilterRequest $request): Response
    {
        try {
            $filter = $request->validated();
            $bookDTOs = $this->bookService->getPaginated($filter);
            return Inertia::render('Books/Index', [
                'books' => $bookDTOs,
                'filters' => $filter
            ]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }

    public function create(): Response
    {
        try {
            return Inertia::render('Books/Create');
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }

    public function store(BookStoreRequest $request): Response|RedirectResponse
    {
        try {
            $this->bookRepository->createFromUser(Auth::id(), $request->all());
            return to_route('books.index')->with(['success' => trans('book.created')]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return Inertia::render('Error', [
                'status' => 500,
            ]);
        }
    }
}
