<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[ 'id' ];


    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function items(){
        return $this->belongsToMany(Item::class,'category_item');
    }

    public function discount()
    {
        return $this->morphOne(Discount::class, 'discountable');
    }
}
