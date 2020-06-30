<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_bill extends Model
{
    protected $table = 'detail_bills';
    protected $primaryKey = 'id_detail_bill';
    public $timestamps = false;
    public $fillable = ['id_bill' ,'id_product', 'quantity_buy', 'amount'];
}
