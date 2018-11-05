<?php

namespace Modules\Academic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

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
        $s = Schedule::where([
            'group_id' => $g->id
        ])->get();
        foreach ($s as $ss) {
            $ss->courses     = $ss->course->name;
            $ss->time     = $ss->start." - ".$ss->end;
            $ss->group     = $g->name;
            $ss->type = "lecture";
            $ss->class = "b 507 room 5  ";
        }

        $r = array_merge(["version"=>1.2],$s->groupBy('day')->toArray());

        return response()->json($r);
        // return ->toJson();
    }
}
