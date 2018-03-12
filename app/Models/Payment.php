<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payment extends Model
{
    use softDeletes;

    public function company(){
        return $this->belongTo('App\Models\Company');
    }

    public function invoice(){
        return $this->belongTo('App\Models\Invoice');
    }


    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }


}