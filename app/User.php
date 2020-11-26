<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $table = 'members';
    public $timestamps = false;

    protected $attributes = [
        'role' => 0,
        'status_member' => 1,
        'img_member' => 'user.jpg'
    ];
    
    protected $fillable = [
        'name_member', 
        'email', 
        'password',
        'phone_number', 
        'address', 
        'gender', 
        'img_member',
        'provider_name',
        'provider_id'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class, 'member_id');
    }

    public function bills()
    {
        return $this->hasManyThrough(Detail_bill::class, Bill::class, 'member_id');
    }

    public function bill()
    {
        return $this->hasMany(Bill::class, 'member_id');
    }
}
