<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'images'
    ];
    protected $casts=['images'=>'array'];
    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_product',
            'product_id', 'category_id'    );
    }
//    public function images(){
//        return $this->hasMany(Product_Image::class, 'product_id', 'id');
//    }
}
