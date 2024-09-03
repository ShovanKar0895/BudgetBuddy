<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use MongoDB\BSON\ObjectId;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddCategoryRequest extends FormRequest
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
            'name' => [
                'required',
                'max:50',
                Rule::unique('categories','name')->where(function ($query) {
                    return $query->where([
                        ['status','!=','5'],
                        ['user_id',new ObjectId(Auth::id())],
                    ]);
                }),
            ],
            'description' => 'required|max:200',
            'remarks' => 'required',
        ];
    }

    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success' => false,
    //         'message' => 'Validation errors',
    //         'data' => $validator->errors()
    //     ], 422));
    // }
}
