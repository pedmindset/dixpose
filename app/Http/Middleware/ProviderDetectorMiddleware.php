<?php

namespace App\Http\Middleware;

use Config;
use Illuminate\Http\Request;

class ProviderDetectorMiddleware
{
    /**
     * @param Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, \Closure $next)
    {
        $validator = validator()->make($request->all(), [
            'username' => 'required',
            'provider' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->getMessageBag(),
                'status_code' => 422
            ], 422);
        }

        Config::set('auth.guards.api.provider', $request->provider);

        return $next($request);
    }
}
