<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryItem extends Pivot
{
    use HasFactory;
    protected $table = 'category_item';
    protected $guarded = ['id'];
}
