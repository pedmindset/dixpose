<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ServiceZone extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];


    public function company(){
        return belongsTo('App\Models\Company');
    }

    public function zone(){
        return belongsTo('App\Models\Zone');
    }

}

