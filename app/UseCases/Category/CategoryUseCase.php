<?php


namespace App\UseCases\Category;


use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\UseCases\BaseUseCase;

abstract class CategoryUseCase extends BaseUseCase
{
    protected $categoryRepo;
    protected $itemRepo;

    public function __construct(CategoryRepository $categoryRepo , ItemRepository $itemRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->itemRepo = $itemRepo;
    }
}
