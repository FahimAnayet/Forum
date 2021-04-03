<?php

namespace App\Http\Middleware;

use Auth;
use Cache;
use Closure;
use Carbon\Carbon;

class CheckActivity
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
        if(Auth::check())
        {
            $expireTime = Carbon::now()->addMinutes(1);
            Cache::put('he-is-fucking-active-'.Auth::user()->id, true, $expireTime);
        }
         return $next($request);
    }
}
