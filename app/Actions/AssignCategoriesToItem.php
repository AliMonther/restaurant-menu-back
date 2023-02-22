<?php


namespace App\Actions;


use App\Models\Item;

class AssignCategoriesToItem
{
    public static function execute(Item $item , $categories){
        foreach ($categories as $category){
            $item->categories()->attach($category);
        }
    }

}
