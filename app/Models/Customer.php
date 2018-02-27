<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Customer extends Model
{
    //
    use SoftDeletes;


    protected $dates = ['deleted_at'];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function zone(){
        return $this->belongsTo('App\Models\Zone');
    }

    public function service_zone(){
        return $this->belongsTo('App\Models\ServiceZone', 'service_zone_id');
    }

    public function classification(){
        return $this->belongsTo('App\Models\Classification');
    }

    public function bin(){
        return $this->BelongsToMany('App\Models\Bin');
    }

    public function collection()
    {
        return $this->hasMany('App\Models\Collection');
    }



}
