<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RateLimitExceededMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //     return $next($request);
    // }
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if ($request->routeIs('getapplicationpage') && $response->status() === 429) {
            return redirect('/')->with('error', 'Rate limit exceeded. Please try again later.');
        }

        return $response;
    }
}
