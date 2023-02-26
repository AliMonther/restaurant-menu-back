<?php


namespace App\Repositories;


use App\Models\Category;
use App\Models\Discount;

class DiscountRepository extends BaseRepository
{
    public function getCategoriesDiscounts($categories){
        return Discount::whereIn('discountable_id',$categories)
            ->where('discountable_type',Category::class)
            ->get()
            ->pluck('value')
            ->toArray();
    }
}
