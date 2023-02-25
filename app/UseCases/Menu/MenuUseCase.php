<?php


namespace App\UseCases\Menu;


use App\Repositories\CategoryRepository;
use App\Repositories\ItemRepository;
use App\Repositories\MenuRepository;
use App\UseCases\BaseUseCase;

abstract class MenuUseCase extends BaseUseCase
{
    protected $menuRepo ;
    protected $categoryRepo ;
    protected $itemRepo ;

    public function __construct(MenuRepository $menuRepo , CategoryRepository $categoryRepo , ItemRepository $itemRepo )
    {
        $this->menuRepo = $menuRepo;
        $this->categoryRepo = $categoryRepo;
        $this->itemRepo = $itemRepo;
    }

}
