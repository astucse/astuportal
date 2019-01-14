<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use App\Models\Employee;
use \Modules\Academic\Entities\Course;
use \Modules\Org\Entities\Department;
// use App\Models\Student;
use Faker\Factory as Faker;
use App\Helpers\EthionameHelper;
class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index','kkk','kkk2');
    }

    public function sssss($idd){
        $faker = Faker::create();
        $a = explode(" ", $idd);
        return $a[0].$a[1][0].$faker->randomDigit.$faker->randomLetter;
    }
    public function kkk2(){
        
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
