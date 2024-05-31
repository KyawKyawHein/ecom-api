<?php

namespace App\Http\Resources;

use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $products = [];
        foreach(Size::all() as $size){
            $products[] = [
                'size' => $size->name,
                'availableColor'=>$this->colors()->where('size_id',$size->id)->get()->map(function ($color){
                  return [
                    "name"=>$color->name,
                    "code"=>$color->code
                  ];
                }),
                'price' => $this->colors()->where('size_id',$size->id)->first()->pivot->price,
                'quantity'=>$this->colors()->where('size_id',$size->id)->first()->pivot->quantity
            ];
        }
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "slug"=>$this->slug,
            "category"=>[
                "name"=>$this->category->name,
                "slug"=>$this->category->slug
            ],
            "image"=>$this->image,
            "description"=>$this->description,
            "products"=>$products
        ];
    }
}
