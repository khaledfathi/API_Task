<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ( Auth::user()->type == 'user'){
            return $next($request);
        }else if ( Auth::user()->type == 'admin'){
            return $next($request);
        }else if ( Auth::user()->type == 'super_admin'){
            return $next($request);
        } 
        return response()->json(['message'=>"User ".Auth::user()->email."not allowed to manange this item" , 'status'=>401]); 
    }
}
