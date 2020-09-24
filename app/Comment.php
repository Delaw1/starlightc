<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'post_id', 'comment'];

    public function Post() {
        return $this->belongsTo('App\Post');
    }

    public function User() {
        return $this->belongsTo('App\User');
    }

    public function Reply() {
        return $this->hasMany('App\Reply')->orderBy('created_at', 'desc');;
    }
}
