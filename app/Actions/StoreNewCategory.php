<?php


namespace App\Actions;


use App\Repositories\CategoryRepository;

class StoreNewCategory
{
    public static function execute( CategoryRepository $categoryRepo, $menu , $parent , $name){

        return $categoryRepo->create([
            'menu_id'=>$menu,
            'parent_id'=>$parent,
            'name'=>$name,
        ]);

    }
}
