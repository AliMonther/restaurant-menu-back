<?php


namespace App\Actions;


class CalculateTotalPrice
{
    public static function execute($price , $discount){
        if($discount){
            return (double)$price - ((double)$price * (double)$discount->value / 100);
        }
        return $price;
    }
}
