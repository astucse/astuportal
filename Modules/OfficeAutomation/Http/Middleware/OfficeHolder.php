<?php

namespace Modules\OfficeAutomation\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class officeHolder
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
        if (Auth::user()->isSecretary || Auth::user()->isDepartmentHead || Auth::user()->isSchoolDean) {
            return $next($request);
        }
        return redirect()->route('index');
    }
}
