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
}
