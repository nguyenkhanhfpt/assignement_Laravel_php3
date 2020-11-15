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

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_colors');
    }

    public function sizes()
    {   
        return $this->belongsToMany(Size::class, 'product_sizes');
    }

    public function scopeAllProduct($query)
    {
        return $query->with(['category', 'images']);
    }
}
