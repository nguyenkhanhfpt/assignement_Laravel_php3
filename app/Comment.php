<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';
    protected $primaryKey = 'id_comment';
    public $timestamps = false;
    public $fillable = ['id_member' ,'content', 'id_product'];
}
