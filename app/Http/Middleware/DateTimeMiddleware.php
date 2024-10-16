<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DateTimeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentDateTime = Carbon::now();
        $currentDate = $currentDateTime->toDateString();
        $currentTime = $currentDateTime->toTimeString();

        view()->share('currentDate', $currentDate);
        view()->share('currentTime', $currentTime);

        return $next($request);
    }
}
