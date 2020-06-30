<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bills';
    protected $primaryKey = 'id_bill';
    public $incrementing = false;
    public $timestamps = false;
    public $fillable = ['id_bill' ,'id_member'];

    public function detail_bill() {
        return $this->hasMany('App\Detail_bill', 'id_bill');
    }
}
