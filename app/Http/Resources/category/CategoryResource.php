<?php

namespace App\Http\Resources\category;

use App\Actions\PrepareDate;
use App\Http\Resources\item\ItemResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
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
            'parent'=>$this->relationLoaded('parent') ?  new CategoryResource($this->parent) : null,
            'children'=>$this->relationLoaded('children') ?   CategoryResource::collection($this->children) : null,
            'items'=>$this->relationLoaded('items') ?  ItemResource::collection($this->items) : null,
            'discount'=>15,
            'created_at'=>PrepareDate::execute($this->created_at),
        ];
    }
}
