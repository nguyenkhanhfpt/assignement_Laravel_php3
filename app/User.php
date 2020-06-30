<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'members';
    protected $primaryKey = 'id_member';
    protected $keyType = 'string';
    public $timestamps = false;

    protected $attributes = [
        'role' => 0,
        'status_member' => 1,
        'img_member' => 'user.jpg'
    ];
    
    protected $fillable = [
        'id_member', 'name_member', 'email', 'password',
        'phone_number', 'address', 'gender', 'img_member'
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

}
