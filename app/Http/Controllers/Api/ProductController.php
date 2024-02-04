<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(isset($_GET['category'])){
            $category = $_GET['category'];
            $products = Product::whereHas('category',function($query) use ($category){
                $query->where('slug',$category);
            })->inRandomOrder()->paginate(10);
        }else{
            $products = Product::inRandomOrder()->paginate(10);
        };
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {

        // move to image
        $file = $request->file('image');
        $imgName = uniqid().$file->getClientOriginalName();
        $file->move(public_path("image/products/"),$imgName);

        $product = Product::create([
            "name" => $request->name,
            'slug' => Str::slug($request->name),
            "description" => $request->description,
            "price" => $request->price,
            "stock_quantity" => $request->stock_quantity,
            "category_id" => $request->category_id,
            "image" => $imgName
        ]);

        return response()->json([
            "status"=>'success',
            "product"=>new ProductResource($product)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $product = Product::with('category')->where('slug',$slug)->first();
        if(!$product){
            return response()->json(['error'=>'Product not found'],400);
        }
        return response()->json(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['error'=>"Product not found."],404);
        }

        // if request has image data  move to image. if not use old image
        if(!$request->file('image')){
            $imgName = $product->image;
        }else{
            File::delete(public_path("image/products/$product->image"));
            $file = $request->file('image');
            $imgName = uniqid() . $file->getClientOriginalName();
            $file->move(public_path("image/products/"), $imgName);
        }


        $product->update([
            "name" => $request->name,
            'slug' => Str::slug($request->name),
            "description" => $request->description,
            "price" => $request->price,
            "stock_quantity" => $request->stock_quantity,
            "category_id" => $request->category_id,
            "image" => $imgName
        ]);

        return response()->json([
            "status" => 'success',
            "product" => new ProductResource($product)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if(!$product){
            return response()->json(['error'=>'Product not found'],404);
        };
        if($product->image){
            File::delete(public_path("image/products/$product->image"));
        };
        $product->delete();
        return response()->json([
            "status"=>"success"
        ]);
    }

    public function getProductByCategory(string $category){
        $findCategory = Category::where('slug',$category)->first();
        if(!$findCategory){
            return response()->json([
                "error"=>'Category not found'
            ],400);
        }
        $products = Product::with('category')->whereHas('category',function($query) use ($category){
            $query->where('slug',$category);
        })->limit(3)->get();

        return response()->json(ProductResource::collection($products));
    }

    public function latestProduct(){
        $product = Product::latest('id')->limit(8)->get();
        return response()->json($product);
    }
}
