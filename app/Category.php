<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    public $timestamps = false;
    public $fillable = [
        'name', 
        'img_category'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
