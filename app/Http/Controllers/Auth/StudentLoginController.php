<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class StudentLoginController extends Controller
{
	use AuthenticatesUsers;
	protected $redirectTo = '/popo';
    public function __construct(){
    	$this->middleware('guest');
    }
    public function showLoginForm(){
    	return view('auth.student_login');
    }
    public function login(Request $request){
    	if(Auth::guard('student')->attempt(['email'=> $request->email , 'password' => $request->password], $request->remember)){
    		// return redirect('/hhh');
    		return redirect()->intended(route('student.index'));
    	}
        return redirect()->back()->withInput($request->only('email'));
    }
    public function logout(Request $request){
    	Auth::logout();
	    // $this->guard()->logout();
	    // $request->session()->flush();
	    // $request->session()->regenerate();
	    return redirect('/kk');
	}
}
