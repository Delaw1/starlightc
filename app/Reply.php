<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['user_id', 'comment_id', 'reply'];

    public function Comment() {
        return $this->belongsTo('App\Comment');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
