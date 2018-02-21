<?php

namespace App\Http\Middleware;
use App\Models\Company;

use Closure;

class VerifyCompany
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $domain = array_get(parse_url($request->url()), 'host');
        $base = array_get(parse_url(config('app.url')), 'host');
        $company_subdomain = trim(str_replace($base, '', $domain), '.');

        //if there is no subdomain then return an error
        if (!$company_subdomain) {
            return abort('404', 'The subdomain must be present in the web address');
        }

        //check if the subdomain belongs to a company
        $company = Company::find(1);
        $subdomain = $company->users()->where('subdomain', $company_subdomain)->firstOrFail();


        return $next($request);
    }
}
