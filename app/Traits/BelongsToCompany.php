<?php

namespace App\Traits;

use App\Scopes\CompanyScope;
use App\Models\User;

trait BelongsToCompany
{
    public static function bootBelongToCompany()
    {
        parent::boot();

        static::addGlobalScope(new CompanyScope);
    }
}