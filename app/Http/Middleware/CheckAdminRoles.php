<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        // dd(Auth::guard('admin')->user()->rol);
        $rol =Auth::guard('admin')->user()->rol;


        if( !in_array ( $rol ,$roles) ){
            return redirect('/admin/no-autorizado');
        }
        return $next($request);
    }
}
