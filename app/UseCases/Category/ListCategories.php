<?php


namespace App\UseCases\Category;


use App\Actions\GetUserMenu;
use App\Http\Resources\category\CategoryCollection;
use App\Http\Resources\category\CategoryResource;

class ListCategories extends CategoryUseCase
{

    public function execute($data){

        if(isset($data['all'])){

            $categories = $this->categoryRepo->getWithAttributes(['menu_id'=>GetUserMenu::execute()->id]);
            return CategoryResource::collection($categories);
        }

        $categories =$this->categoryRepo->paginate(10,['menu_id'=>GetUserMenu::execute()->id]);
        return new CategoryCollection($categories);
    }
}
