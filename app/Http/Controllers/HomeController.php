<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Student;
use \Modules\Academic\Entities\Course;
// use App\Models\Student;
class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('index','kkk','kkk2');
    }

    public function kkk2(){
        // return Course::all()->count();
        $courses = Course::all();
        $arrayName = [];
        foreach ($courses as $course) {
            $c = (object)[];
            $c->name = $course->name;
            $c->code = $course->code;
            $c->crhr = $course->crhr;
            $c->description = $course->description;
            $c->prerequisite = "";
            if (isset($course->prerequisite->code)) {
                $c->prerequisite = $course->prerequisite->code; 
            }
            array_push($arrayName, $c);
        }
        return response()->json($arrayName);

        $c = Collect($courses)->except(['prerequisite','created_at','updated_at','prerequisite_id','prerequisite_id2'])->all();
        return response()->streamDownload(function () {
            // echo "ss";   
           echo Course::all()->except(['prerequisite','created_at','updated_at','prerequisite_id','prerequisite_id2'])->toJson();
            // echo $c;
        }, 'hey.json');
        return response()->json(Collect($courses)->except(['prerequisite','created_at','updated_at','prerequisite_id','prerequisite_id2'])->all());
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
