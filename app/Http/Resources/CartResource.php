<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
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
            "product"=>Product::where('id',$this->product_id)->first(),
            "quantity"=>$this->quantity,
            "price"=>$this->product->price*$this->quantity
        ];
    }
}
