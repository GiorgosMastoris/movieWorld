<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookVoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
            'type' => 'required|in:like,hate',
        ];
    }
}
