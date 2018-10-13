<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect('/home');
            // $guard = array_get($exception->guards(), 0);
            switch ($guard) {
                case 'admin':
                    $login = 'admin.index';
                    break;
                    
                case 'student':
                    $login = 'student.index';
                    break;

                case 'employee':
                    $login = 'employee.index';
                    break;
            }
            return redirect()->guest(route($login));
        }
        return $next($request);
    }
}
