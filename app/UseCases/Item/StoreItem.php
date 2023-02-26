<?php


namespace App\UseCases\Item;


use App\Actions\AssignCategoriesToItem;
use App\Actions\DiscountCreator\DiscountCreatorFactory;
use Illuminate\Support\Facades\DB;

class StoreItem extends ItemUseCase
{

    public function execute($data){
//       DB::beginTransaction();
//       try{
           $item = $this->itemRepo->create(
               [
                   'name'=>$data['name'],
                   'price'=>$data['price'],
               ]
           );

           if (isset($data['categories'])){
               AssignCategoriesToItem::execute($item , $data['categories']);
           }

           //store category discount
           $factory = new DiscountCreatorFactory();

           $discount = isset($data['discount']) ? $data['discount'] : null;
           $factoryData = [
                'discountType'=>'item',
                'model'=>$item,
                'discountValue'=>$discount,
                'discountRepository'=>$this->discountRepo,
                'categories'=>isset($data['categories']) ? $data['categories'] : null,
            ];

           $factory->create($factoryData);

//           DB::commit();
           return $item;

//       }
//       catch (\Exception $e){
//           DB::rollBack();
//           throw new \Exception($e->getMessage(),500);
//       }

    }
}
