<?php


namespace App\Actions;


use App\Models\Category;

class AssignItemsToCategory
{

    public static function execute( Category $category, $items){
            foreach ($items as $item){
                $category->items()->attach($item);
            }
    }
}
