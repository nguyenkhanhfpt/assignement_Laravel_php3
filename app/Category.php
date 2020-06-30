<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_category';
    public $timestamps = false;
    public $fillable = ['name', 'img_category'];
}
