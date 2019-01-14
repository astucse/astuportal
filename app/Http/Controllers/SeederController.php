<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use App\Models\Employee;
use App\Helpers\ImportExportHelper;
class SeederController extends Controller
{
	public function index(){
        return $this->cccc4();
        return $this->ittt();
        return $this->export();
    }
    
    public function cccc4(){
        $deps_ex = \Modules\Org\Entities\Department::whereIn('code',['CSE'])->get();
        $deps = \Modules\Org\Entities\Department::whereIn('duration',[4,5])->get()->diffAssoc($deps_ex);
        foreach ($deps as $dep) {
          return $dep->groups;  
        }
    }
    public function cccc2(){
        $a = \Modules\Academic\Entities\Curriculum::find(1);
        $ans = Collect($a->courses);
        $deps_ex = \Modules\Org\Entities\Department::whereIn('code',['CSE','PCE','ECE'])->get();
        $deps = \Modules\Org\Entities\Department::whereIn('duration',[4,5])->get()->diffAssoc($deps_ex);
        // return $deps;
        foreach ($deps as $dep) {
            $realarr = [
               "department" => $dep->code,
               "schedule" => [
                    [
                       "year" => 1,
                       "semester" => 1,
                       "courses" => [
                         "MATH1101",
                         "PHY1101",
                         "CHEM1101",
                         "CSE1101",
                         "ENG1101",
                         "LAR1101",
                         "HPED1101",
                       ],
                       "electives" => [],
                     ],
                     [
                       "year" => 1,
                       "semester" => 2,
                       "courses" => [
                         "MATH1102",
                         "PHY1102",
                         "DME1102",
                         "CSE1102",
                         "ENG1102",
                         "LAR1102",
                         "HPED1102",
                       ],
                       "electives" => [],
                     ],
                     [
                       "year" => 2,
                       "semester" => 1,
                       "courses" => [
                         "MATH2101",
                         "ECE2101",
                         "PCE2101",
                         "CSE2101",
                         "SOS311",
                       ],
                       "electives" => [],
                     ],
                     [
                       "year" => 2,
                       "semester" => 2,
                       "courses" => [
                         "CEN2201",
                         "ECE2204",
                         "PCE2206",
                         "PCE2208",
                       ],
                       "electives" => [
                         "ELEPCE1",
                       ],
                     ],
                     [
                       "year" => 3,
                       "semester" => 1,
                       "courses" => [
                         "PCE3201",
                         "PCE3203",
                         "PCE3207",
                         "ECE2202",
                       ],
                       "electives" => [
                         "ELEPCE2",
                       ],
                     ],
                     [
                       "year" => 3,
                       "semester" => 2,
                       "courses" => [
                         "PCE3202",
                         "PCE3204",
                         "ECE3204",
                         "PCE3206",
                       ],
                       "electives" => [
                         "ELEPCE3",
                         "ELEPCE3",
                       ],
                     ],
                     [
                       "year" => 3,
                       "semester" => 3,
                       "courses" => [
                         "PCE3200",
                       ],
                       "electives" => [],
                     ],
                     [
                       "year" => 4,
                       "semester" => 1,
                       "courses" => [
                         "PCE4201",
                         "PCE4203",
                       ],
                       "electives" => [
                         "ELEPCEG1",
                         "ELEPCE4",
                         "ELEPCE4",
                         "ELEPCE01",
                       ],
                     ],
                     [
                       "year" => 4,
                       "semester" => 2,
                       "courses" => [
                         "PCE4202",
                         "PCE4204",
                       ],
                       "electives" => [
                         "ELEPCE5",
                         "ELEPCE5",
                         "ELEPCE5",
                         "ELEPCE02",
                       ],
                     ],
                     [
                       "year" => 4,
                       "semester" => 3,
                       "courses" => [
                         "PCE4200",
                       ],
                       "electives" => [],
                     ],
                     [
                       "year" => 5,
                       "semester" => 1,
                       "courses" => [
                         "PCE5201",
                         "PCE5203",
                         "SOS412",
                       ],
                       "electives" => [
                         "ELEPCE6",
                         "ELEPCE6",
                         "ELEPCE03",
                       ],
                     ],
                     [
                       "year" => 5,
                       "semester" => 2,
                       "courses" => [
                         "PCE5202",
                       ],
                       "electives" => [
                         "ELEPCE7",
                         "ELEPCE7",
                         "ELEPCE7",
                         "ELEPCEG2",
                       ],
                     ],
                   ]
            ];
            $ans->push($realarr);
            // $ans =array_merge($ans,$realarr);
            // return "sss";
        }
        $a->courses = $ans;
        $a->save();
        return $ans;
    }
    public function cccc(){
        $a = \Modules\Academic\Entities\Curriculum::find(1);
        $ans = Collect($a->courses);
        $deps_ex = \Modules\Org\Entities\Department::whereIn('code',['CSE','PCE','ECE'])->get();
        $deps = \Modules\Org\Entities\Department::whereIn('duration',[4,5])->get()->diffAssoc($deps_ex);
        // return $deps;
        foreach ($deps as $dep) {
            $realarr = [
               "department" => $dep->code,
               "schedule" => [
                 [
                   "year" => 1,
                   "semester" => 1,
                   "courses" => [
                     "MATH1101",
                     "PHY1101",
                     "CHEM1101",
                     "CSE1101",
                     "ENG1101",
                     "LAR1101",
                     "HPED1101",
                   ],
                   "electives" => [],
                 ],
                 [
                   "year" => 1,
                   "semester" => 2,
                   "courses" => [
                     "MATH1102",
                     "PHY1102",
                     "DME1102",
                     "CSE1102",
                     "ENG1102",
                     "LAR1102",
                     "HPED1102",
                   ],
                   "electives" => [],
                 ],
                 [
                   "year" => 2,
                   "semester" => 2,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 3,
                   "semester" => 1,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 3,
                   "semester" => 2,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 3,
                   "semester" => 3,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 2,
                   "semester" => 2,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 4,
                   "semester" => 1,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 4,
                   "semester" => 2,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 4,
                   "semester" => 3,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 5,
                   "semester" => 1,
                   "courses" => [],
                   "electives" => [],
                 ],
                 [
                   "year" => 5,
                   "semester" => 2,
                   "courses" => [],
                   "electives" => [],
                 ]
                ]
            ];
            $ans->push($realarr);
            // $ans =array_merge($ans,$realarr);
            // $ans
        }
        $a->courses = $ans;
        $a->save();
        return $ans;
    }
    public function ittt(){
        $items = [
            ['code' =>'SES_STUDENT_PERCENT', 'value'=> '50'],
            ['code' =>'SES_COLLEGUE_PERCENT', 'value'=> '15'],
            ['code' =>'SES_HEAD_PERCENT', 'value'=> '35'],
            
            ['code' =>'SES_GOOD_POINT', 'value'=> '4'],
            ['code' =>'SES_BAD_POINT', 'value'=> '2'],
        ];                          
        foreach ($items as $item) {
           \App\Models\Option::create($item);
        }
        foreach (\Modules\Org\Entities\Department::all() as $key => $dep) {
            // $o1 = \App\Models\Option::where(['code' =>'SES_GOOD_REPORT_LETTER','parameter_1'=>''.$dep->id])->first();
            $o2 = \App\Models\Option::where(['code' =>'SES_MEDIUM_REPORT_LETTER','parameter_1'=>''.$dep->id])->first();
            $o3 = \App\Models\Option::where(['code' =>'SES_BAD_REPORT_LETTER','parameter_1'=>''.$dep->id])->first();
            // $o1->value = $this->the_value();
            $o2->value = $this->the_value();
            $o3->value = $this->the_value();
            // $o1->save(); 
            $o2->save(); 
            $o3->save(); 
            // \App\Models\Option::create(['code' =>'SES_MEDIUM_REPORT_LETTER', 'value'=> ''.$this->the_value(),'parameter_1'=>''.$dep->id]);
            // \App\Models\Option::create(['code' =>'SES_BAD_REPORT_LETTER', 'value'=> ''.$this->the_value(),'parameter_1'=>''.$dep->id]);
        }
    }
    public function the_value(){
        return "For the current semester of the current academic year, the evaluation was done by students, colleagues, and department  head.  The  evaluations  weight  50%,  15%,  and  35%  respectively.  Accordingly,  you  have been evaluated by the above three entities and the result shows <<Student>>, <<Colleague>>, and <<Head>> respectively which results in <<Result>> overall performance out of 5 points. \nThis shows that you are discharging your duties and responsibilities effectively. However, more effort is  expected  from  you  to  meet  expectations  of  your  students,  colleagues,  and  the  department  by revising  your  teaching  methodologies,  increasing  your  active  participation  in  SIG  activities, engagement in research duties, and extra-curricular activities. \nThe department likes to thank you for the willingness and participation you exhibited in the making of  a conducive working  environment.  As  the department  is  aspiring more to  dig out  the collective capacities we have together, it needs your proactive participation and is always open to hear your innovative  ideas  you  have  to  share  for  the  betterment  of  the  department  in  particular  and  the university at large.";  
    }
    public function export(){
        ImportExportHelper::export2(Employee::all(),"employee");  
    }
    public function employeepassword(){
        $faker = Faker::create();
        $emp =  \App\Models\Employee::where('initial_password','gukp77')->get();
        foreach ($emp as $employee) {
            $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit; 
            $employee->initial_password = $pass;
            $employee->password = Hash::make($pass);
            $employee->save();
        }
        return "ss";
    }
	public function register(){
		$did = \Modules\Org\Entities\Department::where('code','CSE')->first()->id;
        $r = \App\Models\Role::where(['code'=>'P_STU'])->first();
        foreach (\App\Models\Student::all() as $stu) {
        	\App\Models\AssignedRole::create([
	        	'role_id' => $r->id,'roletaker_id'=>$stu->id,'roletaker_type'=>'student',
	        	'rolegiver_id' =>$did,'rolegiver_type'=>'Org\Department'
	        ]);
        }
        // 
        exit();

		$json_path = base_path('docs/realData/cse_students.json');
        $handle = file_get_contents($json_path, "r");
        $zjson = json_decode($handle);
        $g4 = \Modules\Registration\Entities\ClassroomGroup::where(['batch_year'=>4,'institution_type' => 'Org\Department', 'institution_id'=>$did ]);
        $g5 = \Modules\Registration\Entities\ClassroomGroup::where(['batch_year'=>5,'institution_type' => 'Org\Department', 'institution_id'=>$did ]);
        foreach($zjson as $j){
            $s = \App\Models\Student::where('id_number',$j->id_number)->first();
            if ($j->batch_year == 4) {
	            \Modules\Registration\Entities\StudentEnrollment::create([
					'student_id' => $s->id,
					'group_id' => $g4->get()->random()->id
				]);
            }else{
            	\Modules\Registration\Entities\StudentEnrollment::create([
					'student_id' => $s->id,
					'group_id' => $g5->get()->random()->id
				]);
            }

            // create([
            //     'id_number' => $j->id_number, 
            //     'name' => $j->name, 
            //     'email' => $un."@astuportal.net", 
            //     'password' => $rpass, 
            //     'initial_password' => $pass, 
            //     'disability' => 0, 
            //     'sex' => $j->sex,
            //     'graduated' => 0,
            //     'batch_year' => $j->batch_year
            // ]);
        }
        exit();
	}
	public function group(){
		// $d = \Modules\Org\Entities\Department::where('duration','>=',0)->get();
		$s = \Modules\Org\Entities\School::whereIn('code',['SoEEC','SoMCME','SoANS','SoCEA'])->get();
		// return sizeof($s);
		// foreach ($s as $ss) {
		// 	foreach ([2] as $year) {
		// 		foreach ([1,2,3] as $ddd) {
		// 			\Modules\Registration\Entities\ClassroomGroup::create([
		// 				'name' => $ddd,
		// 				'batch_year' =>$year,
		// 				'semester' => 1,
		// 				'year' => 2011,
		// 	    	    // 'preengineering',
		//     	    	// 'prescience',
		// 		        'school' => 1,
		//         		'institution_id' => $ss->id,
		//  		        'institution_type' => 'Org\School'
		// 			]);
		// 		}
		// 	}
		// }
		// return "s";
		// foreach ($d as $dd) {
		// 	foreach ([3,4,5] as $year) {
		// 		foreach ([1,2,3] as $ddd) {
		// 			\Modules\Registration\Entities\ClassroomGroup::create([
		// 				'name' => $ddd,
		// 				'batch_year' =>$year,
		// 				'semester' => 1,
		// 				'year' => 2011,
		// 	    	    // 'preengineering',
		//     	    	// 'prescience',
		// 		        // 'school',
		//         		'institution_id' => $dd->id,
		//  		        'institution_type' => 'Org\Department'
		// 			]);
		// 		}
		// 	}
		// }
		// return \Modules\Org\Entities\Department::where('duration','>=',0)->count();
	}
    
    public function all(){
    	$faker = Faker::create();
        $json_path = base_path('docs/realData/cse_students.json');
        $handle = file_get_contents($json_path, "r");
        $zjson = json_decode($handle);
        $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit;
        $pass="secret"; 
        $rpass = Hash::make($pass);
        $c = Collect([]);
        $i=2;
        foreach($zjson as $j){
            $a = explode(" ", $j->name);
            $un =  $a[0].$a[1][0];
            if ($c->contains($un)) {
                $un =  $un.$i;
                $c->push($un);
                $i++;
            }else{
                $c->push($un);
            }
            \App\Models\Student::create([
                'id_number' => $j->id_number, 
                'name' => $j->name, 
                'email' => $un."@astuportal.net", 
                'password' => $rpass, 
                'initial_password' => $pass, 
                'disability' => 0, 
                'sex' => $j->sex,
                'graduated' => 0,
                'batch_year' => $j->batch_year
            ]);
        }
        exit();

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
}
