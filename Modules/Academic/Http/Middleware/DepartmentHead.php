<?php

namespace Modules\Academic\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DepartmentHead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        if(Auth::user()->isDepartmentHead){
            return $next($request);
        }
        
        return redirect()->route('index');
    }
}
