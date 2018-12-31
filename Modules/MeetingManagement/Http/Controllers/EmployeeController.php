<?php

namespace Modules\MeetingManagement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;

use App\Models\Employee;
use Modules\MeetingManagement\Entities\Group;
use Modules\MeetingManagement\Entities\Meeting;
use Modules\MeetingManagement\Entities\Agenda;
use PDF;
// use Knp\Snappy\Pdf;

class EmployeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:employee');
    }
    public function index(){
        return view('meetingmanagement::index');
    }
    public function create(){
        return view('meetingmanagement::employee.create');
    }
    public function create_submit(Request $request){
        $g = Group::create([
            'name' => $request['name'],
            'creator_id' => Auth::user()->id, 
            'admin_id' => Auth::user()->id
        ]);
        $g->members()->attach(Auth::user()->id);
        return redirect()->route('meetingmanagement.employee.group_single',['id'=>$g->id]);
    }
    public function meeting_create(Request $request){
        $g = Group::findOrFail($request['group_id']);
        Meeting::create([
             'title' => $request['title'],
             'group_id' => $g->id, 
             'planned_time' => $request['planned_time']
        ]);
        return redirect()->back();
    }
    public function meeting_stop($id){
        $m = Meeting::findOrFail($id);
        $m->active = false;
        $m->save();
        return redirect()->back();
    }
    public function meeting_sign($id){
        $m = Meeting::findOrFail($id);
        // $ps = Meeting::findOrFail($id)->participants()->count();
        $m->participants()->attach(Auth::user()->id, ['signed' => 1]);
        // return $m;
        // foreach ($ps as $p) {
        //     echo $p->name."<br>";
        //     // if($p->is(Auth::user())){
        //     //     $p->pivot->sign = true;
        //     //     $p->save();
        //     // }
        // }
        // return "ss";
        return redirect()->back();
    }
    public function decision_create(Request $request){
        $m = Meeting::find($request['meeting_id']);
        $m->decision = $request['decision'];
        $m->save();
        return redirect()->back();
    }
    public function agenda_create(Request $request){
        Agenda::create([
            'body' => $request['body'],
            'title' => $request['title'],
            'meeting_id' => $request['meeting_id'],
            'raised_by_id' => Auth::user()->id
        ]);
        return redirect()->back();
    }

    public function meeting_single($id){
        $m = Meeting::find($id);
        return view('meetingmanagement::employee.meeting_single',['meeting'=>$m]);
    }
    public function member_add(Request $request){
        $g = Group::find($request['group_id']);
        $g->members()->attach($request['members']);
        return redirect()->back();
    }
    public function update(Request $request){
        $g = Group::find($request['group_id']);
        $g->name = $request['group_name'];
        $g->save();
        return redirect()->back();
    }

    public function group_single($id){
        $g = Group::find($id);
        return view('meetingmanagement::employee.group_single',['group'=>$g,'employees'=>Employee::all()]);
    }
    public function mygroups(){
        $gs3 = Group::all()->filter(function ($item, $key) {
            return $item->members->contains(Auth::user());
        });
        return view('meetingmanagement::employee.mygroups',[
            'groups' => $gs3
        ]);
    }


    public function minute_download($id){
        // $snappy = new Pdf();
        // header('Content-Type: application/pdf');
        // header('Content-Disposition: attachment; filename="file.pdf"');
        // return  $snappy->getOutput('http://www.github.com');
        // return "";
        // $snappy->setOption('toc', true);
        // // $snappy->setOption('xsl-style-sheet', 'http://path/to/stylesheet.xsl') //or local file;
        // $snappy->generateFromHtml('<p>Some content</p>', 'test.pdf');
        // return "";
        $minute = Meeting::findOrFail($id)->decision;
        $people = Meeting::findOrFail($id)->participants;
        // return view('meetingmanagement::employee.minute',['minute'=>$minute]);
        $pdf = PDF::loadView('meetingmanagement::employee.minute2', ['content'=>$minute,'people'=>$people]);
        return $pdf->download('minute.pdf');
    }

}
