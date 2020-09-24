<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ["title", "img", "description"];

    public function Comment() {
        return $this->hasMany("App\Comment")->orderBy('created_at', 'desc');
    }
}
