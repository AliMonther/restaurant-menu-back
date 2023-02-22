<?php


namespace App\UseCases\Item;


use App\Repositories\ItemRepository;
use App\UseCases\BaseUseCase;

abstract class ItemUseCase extends BaseUseCase
{

    protected $itemRepo;

    public function __construct(ItemRepository $itemRepo)
    {
        $this->itemRepo = $itemRepo;
    }
}
