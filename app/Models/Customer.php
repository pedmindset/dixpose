<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\CustomerResetPassword;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

 
    protected $dates = ['deleted_at'];

     /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomerResetPassword($token));
    }

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

    public function invoice()
    {
        return $this->hasMany('App\Models\Invoice');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Payment');
    }



}
