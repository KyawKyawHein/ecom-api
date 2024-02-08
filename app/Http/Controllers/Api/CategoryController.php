<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->get();
        return response()->json(CategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category=Category::create([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name)
        ]);
        return response()->json(new CategoryResource($category));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category = Category::where('slug',$slug)->first();
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 400);
        }
        return response()->json(new CategoryResource($category));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => "Category not found."], 404);
        }
        $category->update([
            'name'=>$request->name,
            "slug"=>Str::slug($request->name)
        ]);
        return response()->json(new CategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return response()->json(['message'=>"Category not found."],404);
        }
        $category->delete();
        return response()->json(new CategoryResource($category));
    }
}
