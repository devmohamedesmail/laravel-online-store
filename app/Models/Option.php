<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;


    // relation with product
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
