<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Supervisor extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function journey(){
        return $this->hasMany('App\Models\Journey');
    }
}
