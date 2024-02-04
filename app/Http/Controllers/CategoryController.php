<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminStoreCategoryRequest;
use App\Http\Requests\AdminUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest('id')->paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    public function show(){
        
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminStoreCategoryRequest $request)
    {
        $category = Category::create([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name)
        ]);
        return redirect()->route('categories.index')->with('success',"$category->name is created.");
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
         $category = Category::where('slug',$slug)->first();
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUpdateCategoryRequest $request, $slug)
    {
        $category = Category::where('slug',$slug)->first();
        $category->update([
            "name"=>$request->name,
            "slug"=>Str::slug($request->name)
        ]);
        return redirect()->route('categories.index')->with('success',"Update successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $category = Category::where('slug',$slug)->first();
        $category->delete();
        return redirect()->back()->with('success',"Delete Successfully.");
    }
}
