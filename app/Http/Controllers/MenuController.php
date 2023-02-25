<?php

namespace App\Http\Controllers;

use App\Http\Resources\menu\MenuResource;
use App\UseCases\Menu\GetMenuDetails;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenuDetails(GetMenuDetails $menuDetails){
        $menuDetails = $menuDetails->execute();
        return $this->success(new MenuResource($menuDetails['menu'] , $menuDetails['items']));
    }
}
