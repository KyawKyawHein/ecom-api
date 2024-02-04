<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->where('status','Pending')->paginate(5);
        foreach($orders as $order){
            $orderItems = OrderItem::with('product')->where('order_id', $order->id)->get();
            $order->order_items = $orderItems;
        }
        return view('admin.order.index', compact('orders'));
    }
    public function getAccepted()
    {
        $orders = Order::with('user')->where('status', 'Accepted')->paginate(5);
        foreach ($orders as $order) {
            $orderItems = OrderItem::with('product')->where('order_id', $order->id)->get();
            $order->order_items = $orderItems;
        }
        return view('admin.order.acceptedOrder', compact('orders'));
    }
    public function getCanceled()
    {
        $orders = Order::with('user')->where('status', 'Canceled')->paginate(5);
        foreach ($orders as $order) {
            $orderItems = OrderItem::with('product')->where('order_id', $order->id)->get();
            $order->order_items = $orderItems;
        }
        return view('admin.order.canceledOrder', compact('orders'));
    }
    public function showOrderItems($id){
        $orderItems = OrderItem::with('product')->where('order_id',$id)->get();
        return view('admin.order.showDetail',compact('orderItems'));
    }
    public function acceptStatus($id){
        $order= Order::where('id',$id)->first();
        $order->status = "Accepted";
        $order->update();
        return redirect()->back()->with('success',"Order Accepted Successfully.");
    }
    public function cancelStatus($id)
    {
        $order = Order::where('id', $id)->first();
        $order->status = "Canceled";
        $order->update();
        return redirect()->back()->with('success', "Order Canceled Successfully.");
    }
}
