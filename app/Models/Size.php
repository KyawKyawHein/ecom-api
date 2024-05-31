<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('price','quantity','color_id');
    }

    public function colors(){
        return $this->belongsToMany(Color::class)->withPivot('price','quantity','size_id');
    }

}
