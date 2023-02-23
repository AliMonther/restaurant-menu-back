<?php


namespace App\Actions;


use App\Repositories\CategoryRepository;

class StoreNewCategory
{
    public static function execute( CategoryRepository $categoryRepo, $menu , $parent , $name){

        if(!$parent){
            $dataToAdd['level'] = 1;
            $dataToAdd['root_parent'] = null;
        }
        else{
            $parentCategory = $categoryRepo->find($parent);
            $dataToAdd['level'] = $parentCategory->level + 1;
            $dataToAdd['root_parent'] = $parentCategory->root_parent ? $parentCategory->root_parent : $parentCategory->id ;
        }
        $dataToAdd['menu_id'] = $menu->id;
        $dataToAdd['parent_id'] = $parent;
        $dataToAdd['name'] = $name;

        return $categoryRepo->create($dataToAdd);

    }
}
