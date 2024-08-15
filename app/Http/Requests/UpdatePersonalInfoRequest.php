<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalInfoRequest extends FormRequest
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
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'user_name' => 'required|max:10',
            'gender' => 'required|in:M,F,P',
            'dob' => 'required',
            'marital_status' => 'required|in:single,married,widowed,divorced,seperated',
            'qualification' => 'required|max:100',
            'occupation' => 'required|max:100',
            'about' => 'required|max:2000',
            'address' => 'required|max:1000',
        ];
    }
}
