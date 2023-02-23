<?php


namespace App\UseCases\Category;


use App\Actions\AssignItemsToCategory;
use App\Actions\GetUserMenu;
use App\Actions\StoreNewCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreCategory extends CategoryUseCase
{


    public function execute($data){
        DB::beginTransaction();
        try{
            //store category info
            $category = StoreNewCategory::execute( $this->categoryRepo, GetUserMenu::execute() , isset($data['parent']) ? $data['parent'] : null , $data['name']);

            //add items to category
            if(isset($data['items']))
                AssignItemsToCategory::execute( $category, $data['items']);
            DB::commit();
            return $category;
        }
        catch (\Exception $e){
            DB::rollBack();
            throw new \Exception($e->getMessage(),500);
        }

    }
}
