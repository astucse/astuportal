<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class EmployeeLoginController extends Controller
{
    public function __construct(){
    	$this->middleware('guest:employee');
    }
    public function showLoginForm(){
    	return view('auth.employee_login');
    }
    public function login(Request $request){
    	if(Auth::guard('employee')->attempt(['email'=> $request->email , 'password' => $request->password], $request->remember)){
    		return redirect()->intended(route('employee.index'));
    	}
        return redirect()->back()->withInput($request->only('email'));
    }
}
