<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;

use App\Helpers\ImportExport as ImportExportHelper;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student')->only(['index','profile','image_upload']);

        $this->middleware('auth:admin')->only(['admin_view','export']);
        
    }
    public function profile(){
        return view('student.profile');
    }
    public function image($id){
        $s = Student::findOrFail($id)->sex;
        $contents = storage_path('profile/student/'.$id.'.jpg');
        if(Storage::exists('profile/student/'.$id.'.jpg'))
            return response()->file(storage_path().'/app/profile/student/'.$id.'.jpg');
        else
            return response()->file(public_path().'/avatars/student'.$s.'.jpg');
        // return Image::make($storagePath)->response();
        // return $contents;
    }
    public function image_upload(Request $request){
        $path = $request->file('picture')->storeAs('profile/student',Auth::user()->id.".jpg");

        return redirect()->back();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin_view(){
        // if(Student::find(1)->OriginalPassword)
        //     return "kkk";
        // else
        //     return "lll";
        // return view('admin.students',['students'=>Student::find([1,2,3,4,5,6,8,9,11,22,33])]);
        return view('admin.students',['students'=>Student::all()]);
    }
    public function export(){
        ImportExportHelper::export('student');
    }

    public function index(){
        return view('student.index');
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
