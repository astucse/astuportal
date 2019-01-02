<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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

            $d = Department::whereNotIn('duration' ,[0])->get()->random();
            return $d;
        $c = Collect([]);
        $ff = EthionameHelper::create();
        for ($i=0; $i < 20; $i++) { 
            $n = $ff->random("F");
            $nn = $this->sssss($n);
            $secreta = array(
                'id_number' => $nn,
                'name'=>$n, 
                'email'=>$nn.'@astuportal.net', 
                'password'=>'$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 
                'initial_password'=>'secret', 
                'sex'=>'F', 
                'disability'=>0, 
                'remember_token'=>'LJZqctV55r', 
            );
            $c->push($secreta);
        }
        return response()->json($c);
        $json_path = base_path('docs/fixtures/secretary.json');
        $handle = file_get_contents($json_path, "r");   
        $zjson = json_decode($handle);
        // $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
        $i=2;
        foreach($zjson as $j){
             if ($c->contains($j->email)) {
                // $ =  $un.$i;
                echo $j->email."<br>";
                // $c->push($un);
                $i++;
            }else{
                $c->push($j->email);
            }
        }
        exit();
        $c = Collect([]);
        // {"id":1,"id_number":"R\/1000\/11","":"Mergo Adnew","":"orie.schoene@astuportal.net","":"$2y$10$b0x2e2RampAgDlvaBQDfjeJZDQAEcA1kjtIADjvxA4c7gwCrjUMgy","":"mrbm05","":0,"":"M","":"",,
        for ($i=0; $i < 20; $i++) { 
            // ;
            # code...
        }
        return "";

        return sizeof($s);
        



        exit();
        // $faker = Faker::create();
        $json_path = base_path('docs/fixtures/students.json');
        $handle = file_get_contents($json_path, "r");
        $zjson = json_decode($handle);
        // $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
        $c = Collect([]);
        $i=2;
        foreach($zjson as $j){
            $d = 12 - substr($j->id_number, 7);
            echo $d."<br>";
            // $a = explode(" ", $j->FullName);
            // $un =  $a[0].$a[1][0];
            // if ($c->contains($un)) {
            //     $un =  $un.$i;
            //     $c->push($un);
            //     $i++;
            // }else{
            //     $c->push($un);
            // }
            // $e = \App\Models\Employee::where(['id_number'=>$un])->first();
            // $r = \App\Models\Role::where(['name'=>$j->Rank])->first();
            // $d = \Modules\Org\Entities\Department::where(['name'=>$j->DepartmentName])->first();
            // if (!isset($d->id)) {
            //     echo $j->DepartmentName."<br>";
            // }
            // App\Models\AssignedRole::create([
            //     'role_id' =>  $r->id,
            //     'roletaker_id' =>  $e->id,
            //     'roletaker_type' =>  'employee',
            //     'rolegiver_id' =>  $d->id,
            //     'rolegiver_type' =>  'Org\\Department'
            // ]);
        }
        exit();
        $json_path = base_path('docs/realData/instructors.json');
        $handle = file_get_contents($json_path, "r");
        $zjson = json_decode($handle);
        $c = Collect([]);
        $i=2;
        foreach($zjson->instructors as $j){
            // print_r($j->FullName);
            // explode(delimiter, string)
            $a = explode(" ", $j->FullName);
            $aa = $a[0].$a[1][0];
            if ($c->contains($aa)) {
                echo $aa.$i."<br>";
                $i++;
                $c->push($aa.$i);
            }else{
            $c->push($aa);
            }
            // echo $a[0].$a[1][0].$a[2][0]."<br>";
            // echo ."<br><br>";
            // $s_id = School::where(['code'=>$j->school])->first()->id;
            // Department::create([
            //     "name" => $j->name,
            //     "code" => $j->code,
            //     "school_id" => $s_id,
            //     "description" => $j->description,
            //     "duration" => $j->duration,
            // ]);
        }

        exit();
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
