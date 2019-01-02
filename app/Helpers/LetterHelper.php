<?php
namespace App\Helpers;

use App\Models\Admin;
use App\Models\School;
use App\Models\Student;
use App\Models\Employee;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
//🐘 🐘 🐘 🐘s
class LetterHelper {
    public static function beautify($string){
        $l = strlen($string);
        $rrr = str_split($string, 100);
        $ans="";
        foreach ($rrr as $value) {
            $ans = $ans.$value."<br>";
        }
        // $ans = "";
        // foreach ($rrr as $value) {
        //     $ans = $ans.$value;
        // }
        return $ans;
    }

}