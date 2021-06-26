<?php

namespace App\Http\Middleware;

use App\Helper;
use Closure;
use Illuminate\Http\Request;
use App\Console\Commands\Keygen as _key;

class LicenseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! _key::_key())
            abort(403);

        return $next($request);
    }
}
