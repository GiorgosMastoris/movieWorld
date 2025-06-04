<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sortBy' => 'in:like,hate,date_of_publication,',
            'userId' => 'integer|exists:users,id',
            'page' => 'integer|min:1'
        ];
    }
}
