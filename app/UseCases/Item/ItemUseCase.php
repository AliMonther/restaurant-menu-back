<?php


namespace App\UseCases\Item;


use App\Repositories\DiscountRepository;
use App\Repositories\ItemRepository;
use App\UseCases\BaseUseCase;

abstract class ItemUseCase extends BaseUseCase
{

    protected $itemRepo;
    protected $discountRepo;

    public function __construct(ItemRepository $itemRepo , DiscountRepository $discountRepo)
    {
        $this->itemRepo = $itemRepo;
        $this->discountRepo = $discountRepo;
    }
}
