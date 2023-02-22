<?php


namespace App\Http\Resources\item;


use App\Http\Resources\category\CategoryResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection
{  public function toArray($request)
{
    return [
        'data' => ItemResource::collection($this->resource),
        'code' => 200,
        'message' => 'Success',
        'pagination' => [
            'size' => $this->perPage(),
            'total' => $this->total(),
            'current' => $this->currentPage(),
            'from' => $this->firstItem(),
            'to' => $this->lastItem(),
            'per_page' => $this->perPage(),
            'last_page' => $this->lastPage(),
        ],
    ];
}


}
