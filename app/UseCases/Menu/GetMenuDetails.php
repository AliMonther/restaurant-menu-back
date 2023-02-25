<?php


namespace App\UseCases\Menu;


use App\Actions\GetUserMenu;
use App\UseCases\Category\ListCategories;

class GetMenuDetails extends MenuUseCase
{
    public function execute($data = null){

        $menu = GetUserMenu::execute();

        $items = $this->itemRepo->getItemsByMenu($menu->id);

        return [
            'menu'=>$menu,
            'items'=>$items,
        ];

    }
}
