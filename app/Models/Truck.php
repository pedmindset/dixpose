<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Truck extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function driver(){
        return $this->belongsTo('App\Models\Driver');
    }

}
