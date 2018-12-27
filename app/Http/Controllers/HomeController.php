<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index','kkk');
    }

    public function kkk(){
       return response()->streamDownload(function () {
            echo Student::all()->toJson();
        }, 'something.json');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guard('employee')->check()){
            return redirect()->route('employee.index');
        }elseif(Auth::guard('student')->check()){
            return redirect()->route('student.index');
        }
        return view('index');
    }
}
