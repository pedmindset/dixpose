<?php

namespace App\Traits;

use App\Scopes\CompanyScope;
use App\Models\User;

trait BelongsToCompany
{
    public static function bootBelongToCompany()
    {
        parent::boot();

        static::creating(function($model)
        {
            $model->company_id = Auth::user()->company_id;
        });

        static::addGlobalScope(new CompanyScope);
    }
}