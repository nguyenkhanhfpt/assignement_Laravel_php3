<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductImage;

class Product extends Model
{
    public $timestamps = false;

    public $fillable = [
        'slug',
        'name_product',
        'category_id',
        'price_product', 
        'sale', 
        'quantity_product',
        'decscription', 
        'nomination',
        'view',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeAllProduct($query)
    {
        return $query->with(['category', 'images']);
    }
}
