<?php

namespace App\Http\Middleware;

use App\Traits\ResponseJSON;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (\Auth::check()) {
            return $next($request);
        } else {
            return response()->json(new ResponseJSON(
                status: false, message: 'Unauthorized'
            ), 401);
        }
    }
}
