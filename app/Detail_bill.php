<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_bill extends Model
{
    protected $table = 'detail_bills';
    public $timestamps = false;
    public $fillable = [
        'bill_id',
        'product_id', 
        'color_id', 
        'size_id',
        'quantity_buy', 
        'amount'
    ];

    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
