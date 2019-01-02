<?php

namespace Modules\OfficeAutomation\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Org\Entities\Department;
use Modules\Org\Entities\Office;
use App\Models\Employee;
use App\Models\Option;
use App\Helpers\LetterHelper;
use Illuminate\Support\Facades\Input;
use Modules\OfficeAutomation\Entities\Letter;
use Auth;
use App\Helpers\CypherHelper;
class EmployeeController extends Controller
{

	protected $office= "";
	public function __construct(){
        $this->middleware('auth:employee');
        $this->middleware('officeautomation.officeholder');

    }
    public function new_letter(){
    	// return ;
    	// $d = 'Hello <b>something Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. </b> ';
    	// $dd = LetterHelper::beautify($d);
        // return view('officeautomation::employee.letter',[
        // 	'staffname' => Employee::all()->random()->name,
        // 	'department' => Department::all()->random()->name,
        // 	'body'=>$dd
        // ]);
        $categories = Option::where('code','OA_LETTER_CATEGORIES')->first()->list;

        return view('officeautomation::employee.new_letter',[
        	'categories' => $categories,
        	'offices' => Office::all()
        ]);
    }


    public function submit_letter(Request $request){
    	if ($request->has('draft')) {
            Letter::create([
            	"body" => $request['body'],
            	// "tags" => $request['cc'],
            	"category" => $request['category'],
            	"owner_id" => Auth::user()->myInstitution->office->id,
            	"to" => [$request['to']],
            	"cc" => $request['cc'],
            	"status" => "draft"
            ]);
    	}else{
    		Letter::create([
            	"body" => $request['body'],
            	// "tags" => $request['cc'],
            	"category" => $request['category'],
            	"owner_id" => Auth::user()->myInstitution->office->id,
            	"to" => [$request['to']],
            	"cc" => $request['cc'],
            	"status" => "sent"
            ]);
    	}
    	return redirect()->back();
    }

    public function outbox_letter(){
    	// return Auth::user()->myInstitution->office;
    	return view('officeautomation::employee.outbox_letters',[
        	// 'categories' => $categories,
        	'letters' => Letter::where(['owner_id'=>Auth::user()->myInstitution->office->id])->get()
        ]);
    }
    public function inbox_letter(){
    	$i = Auth::user()->myInstitution->office->id;
    	$l = Collect([]);
    	$letters = Letter::all();//[where(['to'=>Auth::user()->myInstitution->office->id])->get();
    	foreach ($letters as $letter) {
    		if($letter->status=="sent" && Collect($letter->to)->contains($i)){
    			$l->push($letter);
    		}
    		if($letter->status=="sent" && Collect($letter->cc)->contains($i)){
    			$l->push($letter);
    		}
    	}
    	return view('officeautomation::employee.inbox_letters',[
        	// 'categories' => $categories,
        	'letters' => $l->unique()
        ]);
    }


    public function single_letter($id){
    	$idd = CypherHelper::decypher($id);
    	$letter = Letter::findOrFail($idd);	
        $categories = Option::where('code','OA_LETTER_CATEGORIES')->first()->list;
    	return view('officeautomation::employee.single_letter',[
        	'categories' => $categories,
        	'offices' => Office::all(),
        	'letter' => $letter
        ]);
    }

    public function view_letter($id){
    	$idd = CypherHelper::decypher($id);
    	$letter = Letter::findOrFail($idd);	
        $categories = Option::where('code','OA_LETTER_CATEGORIES')->first()->list;
    	return view('officeautomation::employee.view_letter',[
        	'categories' => $categories,
        	'offices' => Office::all(),
        	'letter' => $letter
        ]);
    }

    public function update_letter(Request $request){
    	$idd = $request['letter_id'];
    	$letter = Letter::findOrFail($idd);	
    	$letter->body = $request['body'];
    	$letter->category = $request['category'];
    	$letter->to = [$request['to']];
    	$letter->cc = $request['cc'];
    	if ($request->has('draft')) {
    		$letter->status = "draft";
    	}else{
    		$letter->status = "sent";
    	}
    	$letter->save();
    	return redirect()->back();

    	// "body" => $request['body'],
    	// // "tags" => $request['cc'],
    	// "category" => $request[''],
    	// "owner_id" => Auth::user()->myInstitution->office->id,
    	// "to" => [$request['to']],
    	// "status" => "sent"
     //    $categories = Option::where('code','OA_LETTER_CATEGORIES')->first()->list;
    	// return view('officeautomation::employee.single_letter',[
     //    	'categories' => $categories,
     //    	'offices' => Office::all(),
     //    	'letter' => $letter
     //    ]);
    }


}
