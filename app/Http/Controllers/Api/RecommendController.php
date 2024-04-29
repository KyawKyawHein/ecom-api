<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRecommendRequest;
use App\Http\Resources\RecommendResource;
use App\Models\Recommend;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecommendController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!$request->get('shopId')){
            return response()->json(['error' => 'Shop ID is required'], 400);
        }elseif(!Shop::where('shopId',$request->get('shopId'))->exists()){
            return response()->json(['error' => 'Shop not found'], 400);
        }
        $recommends = Recommend::where('shopId',$request->get('shopId'));
        if($request->get('rowCount')){
            return $recommends->take($request->get('rowCount'))->get();
        }
        return $recommends->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecommendRequest $request)
    {
        if(!$request->get('shopId')){
            return response()->json(['error' => 'Shop ID is required'], 400);
        }elseif(!Shop::where('shopId',$request->get('shopId'))->exists()){
            return response()->json(['error' => 'Shop not found'], 400);
        }
        $recommend = Recommend::create([
            "shopId" => $request->get('shopId'),
            "user_id" => Auth::id(),
            "text" => $request->get('text'),
        ]);
        return response()->json(new RecommendResource($recommend),201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id,Request $request)
    {
        if(!$request->get('shopId')){
            return response()->json(['error' => 'Shop ID is required'], 400);
        }elseif(!Shop::where('shopId',$request->get('shopId'))->exists()){
            return response()->json(['error' => 'Shop not found'], 400);
        }
        $recommend = Recommend::where('shopId',$request->get('shopId'))->where('id',$id)->first();
        if(!$recommend){
            return response()->json(['error' => 'Recommend not found'], 404);
        }
        return new RecommendResource($recommend);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,Request $request)
    {
        if(!$request->get('shopId')){
            return response()->json(['error' => 'Shop ID is required'], 400);
        }elseif(!Shop::where('shopId',$request->get('shopId'))->exists()){
            return response()->json(['error' => 'Shop not found'], 400);
        }
        $recommend = Recommend::where('shopId',$request->get('shopId'))->where('id',$id)->first();
        if(!$recommend){
            return response()->json(['error' => 'Recommend not found'], 404);
        }
        $recommend->delete();
        return response()->json(null,204);
    }
}
