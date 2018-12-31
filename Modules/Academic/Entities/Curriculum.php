<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Academic\Entities\Course;
use Modules\Org\Entities\Department;
class Curriculum extends Model
{
	protected $table = "academic-curricula";
    protected $fillable = ['version','name','courses','electives'];

    protected $casts = [
        'courses' => 'array',
        'electives' => 'array',
    ];

    public function getElectivessAttribute(){
    	$ans = Collect([]);
        foreach ($this->electives as $elective) {
            $c = "";
            $n = "";
            $d = "";
            $cc = Collect([]);
            foreach ($elective as $key => $value) {
                if ($key=="code") {
                    $c = $value;
                }elseif ($key=="name") {
                    $n = $value;
                }elseif ($key=="description") {
                    $d = $value;
                }elseif ($key=="courses") {
                    foreach ($value as $value2) {
                        $cc->push(Course::all()->where('code',$value2)->first());
                    }
                }
            }
            $ans->push([
                // $c => Collect([
                	"code"=>$c,
                    "name" => $n,
                    "description" => $d,
                    "courses" => $cc,
                // ])
            ]);
        }
        return $ans;
    }


    public function getBreakdownAttribute(){
    	$ans = Collect([]);
    	$eee = $this->electivess;
        foreach ($this->courses as $dd) {
            $scheduless = $dd['schedule'];
            $d = Department::all()->where('code',$dd['department'])->first();
            $schedules = Collect([]);
            foreach ($scheduless as $schedule) {
                $courses = Collect([]);
                foreach ($schedule['courses'] as $cc) {
                    $c = Course::all()->where('code',$cc)->first();
                    $courses->push($c);
                }
	            $electives = Collect([]);
	            // foreach ($schedule['electives'] as $value) {
	            	// $cc = $eee->where('code',$value)->first();
	            	// $cc = $eee['code']

	            	// $electives->push($this->electivess->where('code',$value)->first());
	            	// $electives->push($value);
	            // }
                $schedules->push(Collect(['year'=>$schedule['year'],'semester'=>$schedule['semester'],'courses'=>$courses]));
                // $schedules->push(Collect(['year'=>$schedule['year'],'semester'=>$schedule['semester'],'courses'=>$courses,'electives'=>$electives]));
            }
            $ans->push(Collect(['department'=>$d,'schedules'=>$schedules,'electives'=>$electives]));
        }
        return $ans;
    }

}




// protected $table = "academic-electives";
//     protected $fillable = ['options','crhr','courses','type','code'];
//     public function getCoursessAttribute(){
//     	$arr = explode(',', $this->courses);
//         $ans = [];
//         foreach ($arr as $value) {
//         	if(Course::where('code',$value)->count()==0){
//                 array_push($ans, Course::find(1));
//             }else{
// 	            array_push($ans, Course::where('code',$value)->first());
// 	        }
//         }
//     	if( sizeof($ans)==1 && $ans[0]==null ){
//             return [];
//         }
//         return Collect($ans);
//     } 



// protected $fillable = [
//         'year','semester','institution_id','institution_type','courses','electives','curriculum_id'
//     ];

//     public function getCoursessAttribute(){
//     	$arr = explode(',', $this->courses);
//         $ans = [];
//         foreach ($arr as $value) {
//             if(Course::where('code',$value)->count()==0){
//                 array_push($ans, Course::find(1));
//             }else{
//                 array_push($ans, Course::where('code',$value)->first());
//             }
//         }

//     	if( sizeof($ans)==1 && $ans[0]==null ){
//             return [];
//         }
//         return Collect($ans);
//     }
//     public function getElectivessAttribute(){
//         $arr = explode(',', $this->electives);
//         $ans = [];
//         foreach ($arr as $value) {
//             if(Elective::where('code',$value)->first()!=null)
//                 array_push($ans, Elective::where('code',$value)->first());
//         }
//         if( sizeof($ans)==1 && $ans[0]==null ){
//             return [];
//         }
//         return Collect($ans);
//     }
//     public function getAllCoursessAttribute(){
//         $ans  = $this->coursess;
//         foreach ($this->electivess as $elective) {
//             $ans = $ans->merge($elective->coursess);
//         }
//         return $ans->unique();
//     }
//     public function getTotalCrhrAttribute(){
//     	$k = $this->Coursess->reduce(function ($carry, $item) {
// 		    return $carry + $item->crhr;
// 		});
// 		$k2 = $this->Electivess->reduce(function ($carry, $item) {
// 		    return $carry + $item->crhr;
// 		});

//     	return $k+$k2;
//     }