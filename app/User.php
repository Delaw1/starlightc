<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'username', 'email', 
        'password', 'role', 'department_id', 'approved',
        'referralcode', 'referral', 'wallet', 'account_name', 'account_number', 'bank_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Order() {
        return $this->hasMany('App\Order');
    }

    public function Cart() {
        return $this->hasMany('App\Cart');
    }

    public function Workerstat() {
        return $this->hasOne('App\Workerstat');
    }
}
