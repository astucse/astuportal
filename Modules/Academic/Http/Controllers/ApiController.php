<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Helpers\OptionsHelper;
use Modules\Academic\Entities\Assignment;
use  Modules\Academic\Entities\Department;
use  Modules\Academic\Entities\School;
use  Modules\Academic\Entities\Course;
use  Modules\Academic\Entities\Enrollment;
use  Modules\Academic\Entities\Curriculum;
use  Modules\Academic\Entities\CourseBreakdown;
use  Modules\Academic\Entities\Schedule;
use  Modules\Academic\Entities\Group;
use  Modules\Academic\Entities\Elective;

class ApiController extends Controller
{
    public function assigned_instructors_api(){
        $r = Assignment::where([
            'academic_year' => OptionsHelper::current_year(),
            'semester' => OptionsHelper::current_semester(),
        ])->get();
        return response()->json($r);
    }
    public function schedule_api(){
        // department=cse&year=1&section=3
        $d = $_GET['department'];
        $y = $_GET['year'];
        $g = $_GET['group'];
        
        $ans = ['data'=>false];
        $g = Group::where([
            'institution_type'=> 'Academic\Department',
            'institution_id'=> Department::where(['code'=>$d])->first()->id,
            'name' => $g,
            'batch_year' => $y,
            'semester' => '1',
            'year' => '2011'
        ])->first();
        if($g==null){
            return response()->json($ans);            
        }
        $mm=[];
        $r = ["version"=>1.2];
        foreach (['monday','tuesday','wednesday','thursday','friday','saturday','sunday'] as $day) {
            $gg=[];
            $schedules = Schedule::where([
                'group_id' => $g->id,
                'day' => $day,
            ])->get(); 
            foreach ($schedules as $sched) {
                $m=(object)[];
                $m->courses     = $sched->course->name;
                $m->time     = $sched->start." - ".$sched->end;
                $m->group     = $g->name;
                $m->type = "lecture";
                $m->class = "b 507 room 5  ";
                array_push($gg, $m);
            }
            // array_merge($mm,[$day => $gg]);
            // array_push($mm, (Object)[$day => $gg]);
            $r = array_merge($r,[$day=>$gg]);
        }
        
        // $r = array_merge(["version"=>1.2],$mm);

        return response()->json($r);
        // return ->toJson();
    }
}
