<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
// use MongoDB\Laravel\Eloquent\Casts\ObjectId;
use MongoDB\BSON\ObjectId;

class VerifyCategoryIdForUser implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valueArr = explode("___",$value);
        $subCategoryName = $valueArr[0];
        $categoryObjectId = new ObjectId($valueArr[1]);

        $count = Category::where([
            ['user_id',new ObjectId(Auth::id())],
            ['status','!=','5'],
            ['_id',$categoryObjectId],
            ['remarks', $subCategoryName]
        ])->count();
        
        if($count === 0){
            $fail("The selected {$attribute} is invalid.");
        }
    }
}
