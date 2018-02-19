<?php

use App\User;


class Driver extends User
{

    protected $table = 'users';

    public function truck(){
        return $this->haveMany('App\Models\Truck');
    }

    public function journey(){
        return $this->hasManyThrough('App\Models\Journey', 'App\Models\Truck');
    }
}