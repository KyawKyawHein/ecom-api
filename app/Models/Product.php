<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query,$filter){
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
}
