<?php
namespace App\Helpers;


use App\Models\Admin;
use App\Models\School;
use App\Models\Student;
use App\Models\Employee;
use App\Models\Option;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class OptionsHelper {
    public static function current_curriculum(){
    	$id = Option::where(['code' =>'Academic_curriculum'])->first()->value;
    	return \Modules\Academic\Entities\Curriculum::find($id);
    }
}