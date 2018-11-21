<?php

namespace Modules\Academic\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class SchoolDean
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
        if(Auth::user()->isSchoolDean){
            return $next($request);
        }
        
        return redirect()->route('index');
    }
}
