<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Invoice extends Model
{
    use softDeletes;

    protected $fillable = [
        'collection_id', 'number', 'amount', 'due_date', 'status', 'company_id', 'customer_id'
    ];

    public function company(){
       return $this->belongTo('App\Models\Company');
    }


    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }


    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }
    
}
