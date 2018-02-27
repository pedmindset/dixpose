<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Supervisor extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $guard = 'supervisor';

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


    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function journey(){
        return $this->hasMany('App\Models\Journey');
    }
}
