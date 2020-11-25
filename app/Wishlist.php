<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Wishlist extends Model
{
    protected $fillable = [
        'member_id',
        'product_id'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class);
    }
}
