<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\DriverResetPassword;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone1', 'phone2', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new DriverResetPassword($token));
    }


    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function truck(){
        return $this->belongsToMany('App\Models\Truck');
    }
}
