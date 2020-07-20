<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $table = "feedbacks";
    protected $fillable = ['user_id', 'order_id', 'message'];

    public function Order() {
        return $this->belongsTo("App\Order");
    }

    public function User() {
        return $this->belongsTo('App\User');
    }
}
