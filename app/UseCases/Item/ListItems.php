<?php


namespace App\UseCases\Item;


use App\Actions\GetUserMenu;
use App\Http\Resources\item\ItemCollection;
use App\Http\Resources\item\ItemResource;
use App\Models\Category;
use App\Models\Item;
use App\Models\Menu;

class ListItems extends ItemUseCase
{

    public function execute($data){

        $menuId = GetUserMenu::execute()->id;

        $items = $this->itemRepo->getItemsByMenu($menuId);

        return isset($data['all']) ? ItemResource::collection($items->get()) : new ItemCollection($items->paginate());

    }

}
