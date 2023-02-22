<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $guarded=[ 'id' ];

    public function categories(){
        return $this->belongsToMany(Category::class,'category_item');
    }

    public function discount()
    {
        return $this->morphOne(Discount::class, 'discountable');
    }

    public function menuItems($menuId)
    {
        return $this->belongsToMany(Category::class, 'categories')
            ->whereHas('menu', function ($query) use ($menuId) {
//                dd();
                 $query->where('id', $menuId);
            });
    }

}
