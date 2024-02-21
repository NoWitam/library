<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class BookBorrowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->route('book')->activeLoan === null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'days' => 'nullable|integer|min:3|max:60'
        ];

        if(auth()->user()->role == UserRole::ADMIN) {
            $rules['client_id'] = 'required|exists:users,id';
        }

        return $rules;
    }
}
