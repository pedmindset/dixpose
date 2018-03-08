<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Collection extends Model
{
    //
    use SoftDeletes;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function bin()
    {
        return $this->belongsToMany('App\Models\Bin');
    }

    public function journey()
    {
        return $this->belongsToMany('App\Models\Journey');
    }

  
}
