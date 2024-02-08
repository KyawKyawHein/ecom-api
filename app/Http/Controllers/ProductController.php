<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreProductRequest;
use App\Http\Requests\AdminUpdateProductRequest;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(5);
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreProductRequest $request)
    {
        // store image
        $file = $request->file('image');
        $fileName = uniqid().$file->getClientOriginalName();
        $file->move(public_path('image/products/'),$fileName);

        $product = Product::create([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name),
            "description"=>$request->description,
            'price'=>$request->price,
            "stock_quantity"=>$request->stock_quantity,
            "category_id"=>$request->category_id,
            "image"=>$fileName
        ]);
        return redirect()->route('products.index')->with('success', "$product->name is created.");
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $product = Product::where('slug',$slug)->first();
        $categories = Category::all();
        return view('admin.product.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateProductRequest $request, $slug)
    {
        $product = Product::where('slug',$slug)->first();
        if($request->image){
               //delete old file
            File::delete(public_path("image/products/$product->image"));
            // store new imageio
            $file = $request->file('image');
            $imageName = uniqid().$file->getClientOriginalName();
            $file->move(public_path('image/products/'),$imageName);
        }else{
            $imageName = $product->image;
        }
        $product->update([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name),
            "description"=>$request->description,
            'price'=>$request->price,
            "stock_quantity"=>$request->stock_quantity,
            "category_id"=>$request->category_id,
            "image"=>$imageName
        ]);
        return redirect()->route('products.index')->with('success',"Updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $product= Product::where('slug',$slug)->first();
        if($product->image){
            File::delete(public_path("image/products/$product->image"));
        }
        $product->delete();
        return redirect()->back()->with('success',"Deleted successfully.");
    }
}
