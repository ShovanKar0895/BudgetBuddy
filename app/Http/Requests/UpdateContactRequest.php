<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'contact_number' => ['required','integer','digits:10'],
            'email' => [
                'required',
                'email',
                Rule::unique('users','email')->where(function ($query) {
                    return $query->where('status','!=','5');
                })->ignore(Auth::id(),'_id')
            ],
            'url' => ['required','url'],
        ];
    }
}
