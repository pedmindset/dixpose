<?php
/**
 * Company Global Scope
 */
namespace App\Scopes;

use Illuminate\Database\Model;
use Illuminate\Database\Eleguent;
use Illuminate\Database\Builder;

class CompanyScope implements Scope
{
     /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    
     public function apply(Builder $builder, Model $model)
     {
        return $builder->where('company_id', Auth::user()->company_id);
     }
}
