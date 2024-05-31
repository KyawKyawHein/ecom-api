<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query,$filter){
        $query->when($filter['gender'] ?? false ,function($query,$gender){
            $categoryId = Category::where('slug',$gender)->first()->id;
            $query->where('category_id',$categoryId);
        });
        $query->when($filter['search']??false,function($query,$search){
            $query->where('name','LIKE','%'.$search.'%');
        });
        $query->when($filter['category'] ?? false ,function($query,$slug){
            $query->whereHas('category',function($query) use ($slug){
                $query->where('slug',$slug);
            });
        });
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function colors(){
        return $this->belongsToMany(Color::class,'color_product_size')->withPivot('price','quantity','size_id')->withTimestamps();
    }
    public function sizes(){
        return $this->belongsToMany(Size::class,'color_product_size')->withPivot('price','quantity','color_id')->withTimestamps();
    }
    public function shop(){
        return $this->belongsTo(Shop::class,'shop_id','shopId');
    }
}
