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
        $sizesArr = [];
        foreach($this->sizes as $size){
            $name  =$size->name;
            if(!in_array($name,$sizesArr)){
                $sizesArr[] = $name;
            }
        }
        foreach($sizesArr as $size){
            $products[] = [
                'size' => $size,
                'availableColor'=>$this->sizes()->where('name',$size)->get()->map(function ($product){
                  return [
                    "color"=>$product->pivot->color,
                    "quantity"=>$product->pivot->quantity
                  ];
                }),
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
            "price"=>$this->price,
            "size"=>$sizesArr,
            "products"=>$products,
        ];
    }
}
