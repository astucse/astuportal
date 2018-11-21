<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

use Auth;
class EmployeeController extends Controller
{
    public function __construct(){
        $this->middleware('auth:employee')->only(['index','profile','image_upload']);
        $this->middleware('auth:admin')->only(['admin_view','export']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('employee.index');
    }
    public function profile(){
        return view('employee.profile');
    }
    public function image($id){
        $s = Employee::findOrFail($id)->sex;
        // $contents = storage_path('profile/employee/'.$id.'.jpg');
        if(Storage::exists('profile/employee/'.$id.'.jpg'))
            return response()->file(storage_path().'/app/profile/employee/'.$id.'.jpg');
        else
            return response()->file(public_path().'/avatars/employee'.$s.'.jpg');
        // return Image::make($storagePath)->response();
        // return $contents;
    }
    public function image_upload(Request $request){
        $path = $request->file('picture')->storeAs('profile/employee',Auth::user()->id.".jpg");

        return redirect()->back();
    }
    public function admin_view(){
        return view('admin.employees',['employees'=>Employee::all()]);
    }
    public function export(){
        ImportExportHelper::export('student');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
