<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class Company extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

  
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function zone(){
        return $this->hasMany('App\Zone');
    }

    public function service_zone(){
        return $this->hasMany('App\ServiceZone');
    }

    public function bin(){
        return $this->hasMany('App\Bin');
    }
    

    public function customer(){
        return $this->hasMany('App\Customer');
    }

}
