<?php

namespace App\Rules\category;

use App\Constants\ConfigConstants;
use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Config;
use Illuminate\Contracts\Validation\Rule;

class CheckCategoryChildrenLevelRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {

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
        $parentLevel = Category::find($value);

        $parentItems = CategoryItem::where('category_id',$value)->first();

        $maxLevel = Config::where('key' , ConfigConstants::MAX_SUB_CATEGORIES_LEVEL)->pluck('value')->first();

        return $maxLevel > $parentLevel->level && !$parentItems;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Category has too many levels OR parent category has items , prevent storing it';
    }
}
