<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model
{
    //
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function owner(){
        return $this->belongsTo('App\User');
    }

    public static function boot(){
        parent::boot();
        static::creating(function ($model){
            $model->user_id = App\Models\User::where('id', $model->user_id);
        });
    }

}
