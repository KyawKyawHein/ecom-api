<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;


class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "description"=>$this->description,
            "image"=>$this->image,
            "price"=>$this->price,
            "slug"=>$this->slug,
            "stock_quantity"=>$this->stock_quantity,
            "category"=>$this->category->name
        ];
    }
}
