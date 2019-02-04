<?php

namespace App\Http\Middleware\System;

use Closure;
use \Illuminate\Support\Facades\Auth;

class RoleChecker
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
        $data = explode('/',$request->getPathInfo());
        if($data[1] != str_replace(" ","_", Auth::user()->role)){
            return redirect('/'. str_replace(" ","_", Auth::user()->role) .'/dashboard');
        }
        
        return $next($request);
    }
}
