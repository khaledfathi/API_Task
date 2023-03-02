<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( Auth::user()->type == 'admin'){
            return $next($request);
        }else if ( Auth::user()->type == 'super_admin'){
            return $next($request);
        }
        return response()->json(['message'=>'not authorized' ,'authorized_for'=>'super_admin | admin' , 'status'=>401]); 
    }
}
