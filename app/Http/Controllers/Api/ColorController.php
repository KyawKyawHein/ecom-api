<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){
        $colors = Color::all();
        return response()->json(ColorResource::collection($colors));
    }

    public function create(Request $request){
        $color = Color::create([
            "name"=>$request->name,
            "code"=>$request->code
        ]);
        return response()->json(new ColorResource($color));
    }

    public function destroy(string $id)
    {
        $color = Color::find($id);
        if(!$color){
            return response()->json(['message'=>"Category not found."],404);
        }
        $color->delete();
        return response()->json(new ColorResource($color));
    }
}
