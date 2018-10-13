<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class AdminLoginController extends Controller
{
    public function __construct(){
    	$this->middleware('guest:admin');
    }
    public function showLoginForm(){
    	return view('auth.admin_login');
    }
    public function login(Request $request){
        //if super admin
    	if(Auth::guard('admin')->attempt(['email'=> $request->email , 'password' => $request->password], $request->remember)){
    		return redirect()->intended(route('admin.index'));
    	}
        // //$admin->administrator->email
        // $student = Student::where('email',$request->adminname)->get();
        // $staff = Staff::where('email',$request->adminname)->get();
    	
        // if( $staff->count() > 0 && Hash::check($request->password, $staff[0]->password)  && Auth::guard('admin')->attempt(['administrator_type'=> 'staff', 'administrator_id'=>$staff[0]->id, 'password'=> 'secret'], $request->remember) ){
        //          return redirect()->intended(route('admin.index'));
        // }

        // if( $student->count() > 0 && Hash::check($request->password, $student[0]->password)  && Auth::guard('admin')->attempt(['administrator_type'=> 'App\Student', 'administrator_id'=>$student[0]->id, 'password'=> 'secret'], $request->remember) ){
        //          return redirect()->intended(route('admin.index'));
        // }
        
        return redirect()->back()->withInput($request->only('email'));
    }
    public function logout(){
        return "dddd";
	    $this->guard()->logout();
	    // $request->session()->flush();
	    // $request->session()->regenerate();
	    return redirect('/');
	}
}
