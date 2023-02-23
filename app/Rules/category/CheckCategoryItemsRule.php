<?php

namespace App\Rules\category;

use App\Models\Category;
use App\Models\CategoryItem;
use Illuminate\Contracts\Validation\Rule;

class CheckCategoryItemsRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $categories = Category ::whereIn('parent_id',$value)->first();

        return !$categories;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Some categories have sub categories , prevent storing the item';

    }
}
