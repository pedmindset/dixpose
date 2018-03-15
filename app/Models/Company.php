<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

  
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function zone()
    {
        return $this->hasMany('App\Models\Zone');
    }

    public function service_zone()
    {
        return $this->hasMany('App\Models\ServiceZone', 'id');
    }

    public function bin()
    {
        return $this->hasMany('App\Models\Bin');
    }
    
    public function customer()
    {
        return $this->hasMany('App\Models\Customer');
    }

    public function supervisor()
    {
        return $this->hasMany('App\Models\Supervisor');
    }
    
    public function driver()
    {
        return $this->hasMany('App\Models\Driver');
    }

    public function truck()
    {
        return $this->hasMany('App\Models\Truck');
    }

    public function journey()
    {
        return $this->hasMany('App\Models\Journey');
    }

    public function collection()
    {
        return $this->hasMany('App\Models\Collection');
    }

    public function invoice()
    {
        return $this->hasMnay('App\Models\Invoice');
    }


    public function payment()
    {
        return $this->hasMnay('App\Models\Payment');
    }
    


}
