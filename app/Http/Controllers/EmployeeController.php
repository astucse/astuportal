<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helpers\ImportExportHelper;
use Auth;
class EmployeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:employee')->only(['index','profile','image_upload','profile_edit']);
        $this->middleware('auth:admin')->only(['admin_view','export']);
    }
    public function index(){
        return view('employee.index');
    }
    public function profile(){
        return view('employee.profile');
    }
    public function image($id){
        $s = Employee::findOrFail($id)->sex;
        if(Storage::exists('profile/employee/'.$id.'.jpg'))
            return response()->file(storage_path().'/app/profile/employee/'.$id.'.jpg');
        else
            return response()->file(public_path().'/avatars/employee'.$s.'.jpg');
    }
    public function image_upload(Request $request){
        $path = $request->file('picture')->storeAs('profile/employee',Auth::user()->id.".jpg");

        return redirect()->back();
    }

    public function profile_edit(Request $request){
        $res = ["error"=>[],"success"=>[]];
        if($request->file('picture')){
            $path = $request->file('picture')->storeAs('profile/employee',Auth::user()->id.".jpg");
        }
        if($request['inputPassword1']!=null && $request['inputPassword2']!=null){
            if ($request['inputPassword1']!=$request['inputPassword2']) {
                array_push($res["error"], "password do not match");
            }else{
                array_push($res["success"], "password changed succesfully");
                $e = Employee::find(Auth::user()->id);
                $e->password = Hash::make($request['inputPassword1']);
                $e->save();
            }
        }
        return redirect()->back()->with('editResponse',$res);
    }
    public function admin_view(){
        return view('admin.employees',['employees'=>Employee::all()]);
    }
    public function export(){
        ImportExportHelper::export('employee');
    }
    public function import(Request $request){
        $res =  ImportExportHelper::super_import($request,'employee');
        // print_r($res);
        return redirect()->back()->with('importResponse', $res);
    }
}
