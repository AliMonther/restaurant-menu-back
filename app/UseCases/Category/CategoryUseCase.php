<?php


namespace App\UseCases\Category;


use App\Repositories\CategoryRepository;
use App\Repositories\DiscountRepository;
use App\Repositories\ItemRepository;
use App\UseCases\BaseUseCase;

abstract class CategoryUseCase extends BaseUseCase
{
    protected $categoryRepo;
    protected $itemRepo;
    protected $discountRepo;

    public function __construct(CategoryRepository $categoryRepo , ItemRepository $itemRepo , DiscountRepository $discountRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->itemRepo = $itemRepo;
        $this->discountRepo = $discountRepo;
    }
}
