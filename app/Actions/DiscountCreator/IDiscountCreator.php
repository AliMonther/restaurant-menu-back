<?php


namespace App\Actions\DiscountCreator;


interface IDiscountCreator
{
    public function __construct($data);

    public function addDiscount();
}
