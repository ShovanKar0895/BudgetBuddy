<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use MongoDB\BSON\ObjectId;
// use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddInvestmentRequest extends FormRequest
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
            'type' => 'required|in:FD,RD,SIP',
            'amount' => 'required|numeric',
            'institution' => 'required|max:100',
            'interest_rate' => 'required|numeric',
            'maturity_date' => 'required',
            'frequency' => 'required|in:monthly,quarterly,half-yearly,yearly',
            'commitment_date' => 'required',
            // 'category' => Rule::exists('categories','_id')->where('user_id',new ObjectId(Auth::id())),
            // 'category[]' => 'required',
            'category[]' => [
                'required',
                'array', // Ensure it's an array
                Rule::exists('categories','_id')->where('user_id', new ObjectId(Auth::id())),
            ],
            'note' => 'required|max:100',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
}
