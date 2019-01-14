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
        // return $string;
        $l = strlen($string);
        // $rrr = str_split($string, 100);
        // $ans="";
        // foreach ($rrr as $value) {
        //     $ans = $ans.$value."<br>";
        // }
        $rr = explode("\n", $string);
            $ans2 = "";
        foreach ($rr as $key => $r) {
            $ans = "";
            $rrr = explode(" ", $r);
            $i = 0;
            foreach ($rrr as $value) {
                if ($i>12) {        
                    $i=0;
                    $ans = $ans.$value."<br>";
                }else{
                    $ans = $ans.$value." ";
                    $i++;
                }
            }
            $ans2 = $ans2."<p>".$ans."</p>";
            // $ans2 = '<div class="t m0 x7 hb y19 ff1 fs8 fc0 sc0 ls0 ws0">'.$ans."</div>";
        }
        return $ans2;
    }

}