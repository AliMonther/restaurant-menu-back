<?php


namespace App\UseCases\Category;


use App\Actions\AssignItemsToCategory;
use App\Actions\DiscountCreator\DiscountCreatorFactory;
use App\Actions\GetUserMenu;
use App\Actions\StoreNewCategory;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoreCategory extends CategoryUseCase
{


    public function execute($data){
//        DB::beginTransaction();
//        try{
            //store category info
            $category = StoreNewCategory::execute( $this->categoryRepo, GetUserMenu::execute() , isset($data['parent']) ? $data['parent'] : null , $data['name']);

            //add items to category
            if(isset($data['items']))
                AssignItemsToCategory::execute( $category, $data['items']);

            //store category discount
            $factory = new DiscountCreatorFactory();

            $discount = isset($data['discount']) ? $data['discount'] : null;

            $factoryData = [
                'discountType'=>'category',
                'model'=>$category,
                'discountValue'=>$discount,
                'discountRepository'=>$this->discountRepo,
            ];


            $factory->create($factoryData);


//            DB::commit();
            return $category;
//        }
//        catch (\Exception $e){
//            DB::rollBack();
//            throw new \Exception($e->getMessage(),500);
//        }

    }
}
