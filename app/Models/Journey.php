<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journey extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function company(){
        return $this->belongsTo('App\Models\Company');
    }

    public function driver(){
        return $this->belongsTo('App\Models\Driver');
    }

    public function supervisor(){
        return $this->belongsTo('App\Models\Supervisor');
    }

    public function truck(){
        return $this->belongsTo('App\Models\Truck');
    }

    public function zone(){
        return $this->belongsTo('App\Models\Zone');
    }

    public function service_zone(){
        return $this->belongsTo('App\Models\ServiceZone', 'service_zone_id');
    }

    public function collection()
    {
        return $this->belongsToMany('App\Models\Collection');
    }

}
