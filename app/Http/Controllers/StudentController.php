<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Freshbitsweb\Laratables\Laratables;
// use App\Laratables\User as UserLaratables;
use App\Helpers\ImportExport as ImportExportHelper;
use JavaScript;
use Lava;
use \Khill\Lavacharts\Lavacharts;
use Modules\Org\Entities\Department;
class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student')->only(['index','profile','image_upload']);

        $this->middleware('auth:admin')->only(['admin_view','export','update']);
        
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
        $lava = new Lavacharts;
        $reasons = $lava->DataTable();
        $reasons->addStringColumn('Reasons')
                ->addNumberColumn('Percent')
                ->addRow(array('Check Reviews', 5))
                ->addRow(array('Watch Trailers', 2))
                ->addRow(array('See Actors Other Work', 4))
                ->addRow(array('Settle Argument', 89));
        $donutchart = $lava->DonutChart('IMDB', $reasons, [
                        'title' => 'Reasons I visit IMDB'
                    ]);
        // return $donutchart;
        // $stocksTable = new \Lava\DataTable();  // Lava::DataTable() if using Laravel
        // $stocksTable->addDateColumn('Day of Month')
        //             ->addNumberColumn('Projected')
        //             ->addNumberColumn('Official');
        // // Random Data For Example
        // for ($a = 1; $a < 30; $a++) {
        //     $stocksTable->addRow([
        //       '2015-10-' . $a, rand(800,1000), rand(800,1000)
        //     ]);
        // }
        // return $stocksTable;
        // if(Student::find(1)->OriginalPassword)
        //     return "kkk";
        // else
        //     return "lll";
        // return view('admin.students',['students'=>Student::find([1,2,3,4,5,6,8,9,11,22,33])]);
        // JavaScript::put([
        //     'foo' => 'bar',
        //     'user' => Student::first(),
        //     'age' => 29
        // ]);
        // return View::make('admin.students');
        return view('admin.students',['departments'=>Department::all()]);
    }

    public function datatables(){
        return Laratables::recordsOf(Student::class);
        // return Laratables::recordsOf(Student::class, function($query){
        //     return $query->with('group');
        //     // return $query->where('graduated', 0);
        // });
    }

    public function export(){
        ImportExportHelper::export('student');
    }

    public function update(Request $request){
        $student = Student::findOrFail($request['id']);
        $student->name = $request['name'];
        $student->email = $request['email'];
        $student->sex = $request['sex'];
        $student->save();
        return redirect()->back();
        // return $student->name;
        // ImportExportHelper::export('student');
    }

    public function index(){
        return view('student.index');
    }

    
}
