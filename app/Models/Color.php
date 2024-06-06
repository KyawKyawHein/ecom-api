<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function products(){
        return $this->belongsToMany(Product::class)->withPivot('quantity','size_id');
    }
    public function sizes(){
        return $this->belongsToMany(Size::class)->withPivot('quantity','product_id');
    }
}
