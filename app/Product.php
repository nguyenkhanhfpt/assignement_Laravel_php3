<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id_product';
    protected $keyType = 'string';
    public $timestamps = false;
    public $fillable = ['id_product' ,'name_product', 'id_category', 'price_product', 
        'sale', 'quantity_product', 'img_product', 'decscription', 'nomination',
        'view', 'img_product_2', 'img_product_3'];
}
