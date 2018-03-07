<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payment extends Model
{
    use softDeletes;

    public function company(){
        $this->belongTo('App\Models\Company');
    }

    public function invoice(){
        $this->belongTo('App\Models\Invoice');
    }


}