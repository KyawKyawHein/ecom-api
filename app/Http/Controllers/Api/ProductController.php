<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            // $count = $request->get('count');
            // $products = Product::latest()->filter(request(['gender','category', 'search']))->with('category','colors','colors.size','sizes','sizes.color');
            // $countProducts = $products->count();
            // $filterProducts = $products->take($count??1000)->get();
            // return $products;

            // return response()->json([
            //     'data'=>ProductCollection::collection($filterProducts),
            //     'count'=>$countProducts
            // ]);
            $products = Product::latest()->with('sizes','colors')->get();
            // return $products;
            return ProductCollection::collection($products);
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        // move to image
        // $file = $request->file('image');
        // $imgName = uniqid().'.'.$file->getClientOriginalExtension();
        // $path = 'http://127.0.0.1:8000/image/products/'.$imgName;
        // $file->move(public_path("image/products/"),$imgName);

        // need shopId and color
        $product = Product::create([
            "shop_id"=>$request->shopId,
            "name" => $request->name,
            'slug' => uniqid() . Str::slug($request->name).uniqid(),
            "description" => $request->description,
            "category_id" => $request->category,
            "image" => $request->image,
            "price"=>$request->price
        ]);
        foreach($request->size as $sizeId){
            foreach($request->quantity as $productCount){
                $product->sizes()->attach($sizeId, [
                    'color' => $productCount['color'],
                    'quantity'=>$productCount['count']
                ]);
            }
        }
        return response()->json('Products create successfully',200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $product = Product::with('category')->where('slug', $slug)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 400);
        }
        return response()->json(new ProductResource($product));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $slug)
    {
        $product = Product::where('slug', $slug)->first();
        if (!$product) {
            return response()->json(['error' => "Product not found."], 404);
        }

        // if request has image data  move to image. if not use old image
        // if(!$request->file('image')){
        //     $imgName = $product->image;
        // }else{
        //     File::delete(public_path("image/products/$product->image"));
        //     $file = $request->file('image');
        //     $imgName = uniqid().'.'.$file->getClientOriginalExtension();
        //     $path = 'http://127.0.0.1:8000/image/products/'.$imgName;
        //     $file->move(public_path("image/products/"), $imgName);
        // }
        $product->update([
            "name" => $request->name,
            'slug' => Str::slug($request->name),
            "description" => $request->description,
            "price" => $request->price,
            "stock_quantity" => $request->stock_quantity,
            "category_id" => $request->category_id,
            "image" => $request->image
        ]);

        return response()->json(new ProductResource($product));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        };
        if ($product->image) {
            File::delete(public_path("image/products/$product->image"));
        };
        $product->delete();
        return response()->json(new ProductResource($product));
    }

    public function getProductByCategory(string $category)
    {
        $findCategory = Category::where('slug', $category)->first();
        if (!$findCategory) {
            return response()->json([
                "error" => 'Category not found'
            ], 400);
        }
        $products = Product::with('category')->whereHas('category', function ($query) use ($category) {
            $query->where('slug', $category);
        })->get();

        return response()->json(ProductResource::collection($products));
    }

    public function latestProduct()
    {
        $product = Product::latest('id')->limit(8)->get();
        return response()->json($product);
    }

    public function uploadPhoto(Request $request)
    {
        try {
            //validation
            $validator = Validator::make($request->all(), [
                'image' => ['required', 'mimes:png,jpg,jpeg,webp']
            ]);

            if ($validator->fails()) {
                $errors = collect($validator->errors())->flatMap(function ($e, $field) {
                    return [$field => $e[0]];
                });
                return response()->json([
                    'errors' => $errors,
                    'status' => 400
                ], 400);
            }
            $path = 'http://127.0.0.1:8000/image/' . request('image')->store('/products');
            return response()->json([
                'path' => $path,
                'status' => 200
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
}
