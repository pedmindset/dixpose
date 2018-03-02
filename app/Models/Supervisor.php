<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\SupervisorResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Supervisor extends Authenticatable
{
    use Notifiable, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone1', 'phone2', 'address',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new SupervisorResetPassword($token));
    }

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function journey(){
        return $this->hasMany('App\Models\Journey');
    }
}
