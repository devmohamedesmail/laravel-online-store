<?php

namespace App\Models;

use App\Models\Product;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = ['name'];



    public function productsAttributes(){
        return $this->belongsTo(Product::class);
    }
    public function values(){
        return $this->hasMany(AttributeValue::class);
    }
}
