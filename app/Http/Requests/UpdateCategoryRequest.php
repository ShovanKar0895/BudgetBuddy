<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use MongoDB\BSON\ObjectId;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = $this->route('category_id');
        $categoryObjectId = new ObjectId($categoryId);

        return [
            'name' => [
                'required',
                'max:50',
                Rule::unique('categories','name')->where(function ($query) use ($categoryObjectId) {
                    return $query->where([
                        ['status','!=','5'],
                        ['user_id',new ObjectId(Auth::id())],
                    ]);
                })->ignore(new ObjectId($categoryObjectId),'_id')
            ],
            'description' => 'required|max:200',
            'remarks' => 'required',
        ];
    }
}
