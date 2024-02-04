<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index(){
        $banners = Banner::latest()->paginate(5);
        foreach ($banners as $banner) {
            $banner->status = $banner->expire_date > now() ? 'Active' : 'Expired';
        };
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "image" => ['required', 'mimes:png,jpg,jpeg'],
            "url" => ['url'],
            "expire_date" => ['required', 'date', 'after:today']
        ]);
        //move image to public
        $file = $request->file('image');
        $fileName = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('image/banners'), $fileName);
        Banner::create([
            "image" => $fileName,
            "url" => $request->url,
            "expire_date" => $request->expire_date
        ]);
        return redirect()->route('banners.index')->with('success', "Banner is created.");
    }

    public function destroy(string $id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->back()->with("success", "Successfully deleted.");
    }
}
