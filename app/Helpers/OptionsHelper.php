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
    public static function current_semester(){
    	return Option::where(['code' =>'Academic_semester'])->first()->value;
    }
    public static function current_year(){
    	return Option::where(['code' =>'Academic_year'])->first()->value;
    }

    public static function ses_reports($id){
        return [
            'good' => Option::where(['code' => 'SES_GOOD_REPORT_LETTER','parameter_1'=>$id])->first()->value,
            'medium' => Option::where(['code' => 'SES_MEDIUM_REPORT_LETTER','parameter_1'=>$id])->first()->value,
            'bad' => Option::where(['code' => 'SES_BAD_REPORT_LETTER','parameter_1'=>$id])->first()->value,
        ];
    }
}