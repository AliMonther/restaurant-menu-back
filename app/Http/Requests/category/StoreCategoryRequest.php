<?php

namespace App\Http\Requests\category;

use App\Rules\category\CheckCategoryChildrenLevelRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [ 'required' , 'string' ],
            'parent' => [ 'sometimes' , 'numeric', 'exists:categories,id' , new CheckCategoryChildrenLevelRule() ],
            'items' => [ 'sometimes' , 'array' ],
            'items.*' => ['exists:items,id' ],
            ];
    }
}
