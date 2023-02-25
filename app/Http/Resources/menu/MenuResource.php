<?php

namespace App\Http\Resources\menu;

use App\Http\Resources\category\CategoryResource;
use App\Http\Resources\item\ItemCollection;
use App\Http\Resources\item\ItemResource;
use App\UseCases\Item\ListItems;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
{
    protected $menuCategories;
    protected $menuItems;
    public function __construct($resource , $menuItems  )
    {
        parent::__construct($resource);
        $this->menuItems = $menuItems;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'categories'=> CategoryResource::collection($this->categories()->orderBy('id','desc')->get()),
            'items'=> ItemResource::collection($this->menuItems->get()),
        ];
    }
}
