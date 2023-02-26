<?php

namespace App\Http\Resources\item;

use App\Actions\CalculateTotalPrice;
use App\Actions\PrepareDate;
use App\Http\Resources\category\CategoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource
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
          'price'=>$this->price,
          'discount' =>$this->discount ? $this->discount->value : 0,
          'price_after_discount' => CalculateTotalPrice::execute($this->price , $this->discount),
          'categories'=>$this->relationLoaded('categories') ? CategoryResource::collection($this->categories) : null,
          'created_at' => $this->created_at ? PrepareDate::execute($this->created_at) : null,
        ];
    }
}
