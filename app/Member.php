<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public $table = 'members';
    protected $primaryKey = 'id_member';
    protected $keyType = 'string';
    public $timestamps = false;

    // protected $attributes = [
    //     'role' => 0,
    //     'status_member' => 1,
    //     'img_member' => 'user.jpg'
    // ];
    
    protected $fillable = [
        'id_member', 'name_member', 'email', 'password',
        'phone_number', 'address', 'gender', 'img_member'
    ];
}
