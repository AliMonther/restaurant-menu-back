<?php


namespace App\UseCases\Category;


use App\Actions\AssignItemsToCategory;
use App\Actions\GetUserMenu;
use App\Actions\StoreNewCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class StoreCategory extends CategoryUseCase
{


    public function execute($data){
        //store category info
        $category = StoreNewCategory::execute( $this->categoryRepo, GetUserMenu::execute() , $data['parent'] ? $data['parent'] : null , $data['name']);

        //add items to category
        if(isset($data['items']))
            AssignItemsToCategory::execute( $category, $data['items']);

        return $category;
    }
}
