<?php


namespace App\UseCases\Item;


use App\Actions\AssignCategoriesToItem;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class StoreItem extends ItemUseCase
{

    public function execute($data){
       DB::beginTransaction();
       try{
           $item = $this->itemRepo->create(
               [
                   'name'=>$data['name'],
                   'price'=>$data['price'],
               ]
           );

           if (isset($data['categories'])){
               AssignCategoriesToItem::execute($item , $data['categories']);
           }
            DB::commit();
           return $item;

       }
       catch (\Exception $e){
           DB::rollBack();
           throw new \Exception($e->getMessage(),500);
       }

    }
}
