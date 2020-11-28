<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;
    public $fillable = [
        'member_id',
        'date_buy',
        'code_id',
        'status',
    ];

    public function detail_bill()
    {
        return $this->hasMany(Detail_bill::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class);
    }

    public function code()
    {
        return $this->belongsTo(Code::class);
    }
}
