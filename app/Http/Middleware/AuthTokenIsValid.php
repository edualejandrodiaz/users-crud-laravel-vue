<?php

namespace App\Http\Middleware;

use Closure;

class AuthTokenIsValid
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
        
        if( !$request->header('x-ccloud-auth') ||  $request->header('x-ccloud-auth')!=='prueba'){
            return response()->json(['error' => '403 Forbidden', 'code' => 403], 403);
        }
        
        return $next($request);
    }
}
