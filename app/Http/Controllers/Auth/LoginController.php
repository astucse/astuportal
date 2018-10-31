<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function logout(Request $request) {
      Auth::logout();
      $request->session()->invalidate();
      return redirect('/login');
    }

    public function any_login(Request $request){
        if(Auth::guard('student')->attempt(['email'=> $request->email , 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('student.index'));
        }
        if(Auth::guard('employee')->attempt(['email'=> $request->email , 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('employee.index'));
        }
        return redirect()->back()->withInput($request->only('email'));
    }
}
