<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Bin extends Model
{
    //


    protected $dates = ['deleted_at'];


    public function company(){
        return $this->belongsTo('App\Models\Company');
    }
    
    public function customer(){
        return $this->belongsToMany('App\Models\Customer');
    }

    public function collection()
    {
        return $this->belongsToMany('App\Models\Collection');
    }

    public function classification()
    {
        return $this->belongsTo('App\Models\Classification');
    }



   
}
