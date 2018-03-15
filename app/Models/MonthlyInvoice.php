<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MonthlyInvoice extends Model
{
    use softDeletes;

    protected $fillable = [
        'invoice_id', 'number', 'amount', 'due_date', 'status', 'company_id'
    ];

    public function company(){
       return $this->belongTo('App\Models\Company');
    }


    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    


}
