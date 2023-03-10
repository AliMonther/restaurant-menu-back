<?php

namespace App\Http\Requests\item;

use App\Rules\category\CheckCategoryItemsRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreItemRequest extends FormRequest
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
            'name' => ['required' , 'string'],
            'price' => ['required' , 'numeric'],
            'discount' => ['numeric'],
            'categories' => ['required' , 'array' , new CheckCategoryItemsRule()],
            'categories.*' => [ 'numeric' , 'exists:categories,id'],
        ];
    }
}
