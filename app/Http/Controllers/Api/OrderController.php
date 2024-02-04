<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('user')->paginate(20);
        if($orders){
            foreach ($orders as $key => $order) {
                foreach($order->items as $item){
                    $product_name = Product::where('id',$item->product_id)->pluck('name');
                    $order->product_name=$product_name[0];
                }
            };
        return response()->json($orders,200);
        }else{
            return response()->json(['error'=>"There is no product."],404);
        }
    }

    public function show($id){
        $order = Order::find($id);
        if(!$order){
            return response()->json(["error"=>"Order not found."],404);
        }else{
            return response()->json($order,200);
        }
    }

    public function store(Request $request){
        $request->validate([
            "order_items" =>['required'],
            "total_price"=>'required',
        ]);

            // create order
            $order = Order::create([
                "user_id" => Auth::id(),
                "total_price"=>$request->total_price,
                "comment"=>$request->comment
            ]);

            //create order items
            foreach($request->order_items as $order_item){
                $item = OrderItem::create([
                    "order_id"=>$order->id,
                    "product_id"=>$order_item['product_id'],
                    "quantity"=>$order_item['quantity'],
                    "price"=>$order_item['price']
                ]);
                $product= Product::where('id',$order_item['product_id'])->first();
                $product->stock_quantity -= $item->quantity;
                $product->save();
            };
            //delete products from cart after making order
            Cart::where('user_id',$order->user_id)->delete();
            //reduce money and transfer to admin
            User::where('id',$order->user_id)->decrement('money',$order->total_price);
            $admin = User::where('isAdmin','true')->first();
            $admin->money = DB::raw($admin->money+$order->total_price);
            $admin->update();

            return response()->json([
                "status"=>'success',
                "order"=>$order,
                "user"=>new UserResource(User::where('id',$order->user_id)->first())
            ],201);
    }

    public function get_order_items($id){
        $order_items = OrderItem::where('order_id',$id)->get();
        if($order_items){
            foreach ($order_items as $key => $order_item) {
                $product_name = Product::where('id',$order_item->product_id)->pluck('name');
                $order_item->product_name($product_name);
            }
            return response()->json($order_items);
        }else{
            return response()->json('No items found.');
        }
    }

    public function get_user_orders($id){
        $orders = Order::where('user_id',$id)->with('items',function($query){
            $query->orderBy('created_at','desc');
        })->get();

        if($orders){
            foreach ($orders as $key => $order) {
                foreach($orderpost->items as $item){
                    $product = Product::where('id',$item->product_id)->pluck('name');
                    $item->product_name = $product[0];
                }
            }
            return response()->json($orders);
        }else{
            return response()->json("No orders found for this user.");
        }
    }

    public function change_order_status($id,Request $request){
        $order = Order::find($id);
        if($order){
            $order->update([
                "status"=>$request->status
            ]);
            return response()->json($order);
        }else{
            return response()->json("Order was not found.");
        }
    }
}
