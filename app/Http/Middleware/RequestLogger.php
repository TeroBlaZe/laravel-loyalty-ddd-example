<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestLogger
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
        \Log::info(sprintf('Incoming request: %s %s', $request->method(), $request->getRequestUri()), $request->toArray());

        return $next($request);
    }
}
