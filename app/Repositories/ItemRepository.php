<?php


namespace App\Repositories;


use App\Models\Item;

class ItemRepository extends BaseRepository
{
    public function getItemsByMenu($menuId){
        return Item::whereHas('categories',function ($query) use ($menuId) {
            return $query->whereHas('menu',function ($q) use ($menuId) {
                return $q->where('id',$menuId);
            });
        })->orderByDesc('id');

    }

}
