<?php


namespace App\Actions\DiscountCreator;


use InvalidArgumentException;

class DiscountCreatorFactory
{
    protected $discounts = [
        'menu' => MenuDiscountCreator::class,
        'category' => CategoryDiscountCreator::class,
        'item' => ItemDiscountCreator::class,
    ];
//$discountType , $model , $discountValue , $discountRepository
    public function create($data) {

        if (!array_key_exists($data['discountType'], $this->discounts)) {
            throw new InvalidArgumentException("Invalid discount : {$data['discountType']}");
        }

        $discountClass = $this->discounts[$data['discountType']];

        return new $discountClass($data);

    }
}
