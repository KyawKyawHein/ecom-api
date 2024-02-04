<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $request->validate([
            "product_id" =>['required','exists:products,id'],
            "user_id"=>['required','exists:users,id'],
            "quantity"=>['required']
        ]);
        $cart=Cart::create([
            "product_id"=>$request->product_id,
            "user_id"=>$request->user_id,
            "quantity" =>$request->quantity
        ]);
        return response()->json(new CartResource($cart));
    }

    public function showCart(Request $request){
        $carts= Cart::where('user_id',$request->user()->id)->get();
        return response()->json(CartResource::collection($carts));
    }

    public function removeFromCart(Request $request){
        $request->validate([
            "cart_id"=>['required','exists:carts,id']
        ]);
        $cart = Cart::find($request->cart_id);
        $cart->delete();
        $remainCarts = Cart::latest('id')->get();
        return response()->json(CartResource::collection($remainCarts));
    }

    public function removeAllCart(Request $request){
        $carts = Cart::where('user_id',$request->user()->id)->get();
        foreach($carts as $cart){
            $cart->delete();
        }
        return response()->json([],204);
    }
}
