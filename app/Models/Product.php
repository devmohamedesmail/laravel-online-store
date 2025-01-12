<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Option;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $casts = [
        "gallery"=> "array",
    ];

    // relation with category
    public function category(){
        return $this->belongsTo(Category::class);
    }
    // raltion with attribute
    public function attributes(){
        return $this->hasMany(Attribute::class);
    }

    public function variations(){
        return $this->hasMany(Variation::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class,'product_id', 'id');
    }

    // relation with options
    public function options(){
        return $this->hasMany(Option::class);
    }
}
