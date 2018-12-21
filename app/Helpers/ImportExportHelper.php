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
class ImportExportHelper {
    public static function export2($model,$type){
        $fillables = $model[0]->getFillable();
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('ASTU PORTAL')
            ->setLastModifiedBy('ASTU PORTAL')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Student data')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');

        foreach ($fillables as $kk => $fillable) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue(chr(65 + $kk). 1, $fillable);
        }
        foreach ($model as $k => $s) {
            foreach ($fillables as $kk => $fillable) {
                $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue(chr(65 + $kk). ($k+2), $s[$fillable]);
            }            
        }
        $spreadsheet->getActiveSheet()->setTitle($type.'s');
        $spreadsheet->setActiveSheetIndex(0);
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$type.'s.xlsx"');
        $writer->save("php://output");
    }
    public static function export($type){
        if($type=="student"){
            $model = Student::all();
            $fillables = Student::inRandomOrder()->get()[0]->getFillable();
        }
        elseif($type=="employee"){
            $model = Employee::all();
            $fillables = Employee::inRandomOrder()->get()[0]->getFillable();
        }
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('ASTU PORTAL')
            ->setLastModifiedBy('ASTU PORTAL')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription($type.' data')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');
        foreach ($fillables as $kk => $fillable) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue(chr(65 + $kk). 1, $fillable);
        }
        foreach ($model as $k => $s) {
            foreach ($fillables as $kk => $fillable) {
                $spreadsheet->setActiveSheetIndex(0)
                            ->setCellValue(chr(65 + $kk). ($k+2), $s[$fillable]);
            }            
        }
        $spreadsheet->getActiveSheet()->setTitle($type.'s');
        $spreadsheet->setActiveSheetIndex(0);
        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$type.'s.xlsx"');
        $writer->save("php://output");
    }
    public static function super_import(Request $request, $type){
        $theresponse = ["error"=>[],"success"=>[]];
        $extension = $request->thefile->extension();
        if ($extension == "bin" || $extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            $path = $request->thefile->getRealPath();
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($path);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            $totalColumns = 0;
            $faker = Faker::create();
            foreach ($sheetData as $k=>$row) {
                if($k==1){
                    for ($i=65; $i < 91; $i++) {
                        $cha =  \IntlChar::chr($i);
                        if ($row[$cha]==null) {
                            break;
                        }
                        $totalColumns++;
                    }    
                }else{
                    $arrayName = [];
                    $pass = $faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomLetter.$faker->randomDigit.$faker->randomDigit;
                    for ($i=65; $i < 65+$totalColumns ; $i++) { 
                        $cha =  \IntlChar::chr($i);
                        $arrayName[$sheetData[1][$cha]] = $row[$cha];
                    }
                    if(!isset($arrayName['email'])){
                        $arrayName['email'] = $faker->unique()->userName.$faker->unique()->numberBetween(1000, 9999)."@astuportal.net";
                    }
                    if(!isset($arrayName['id_number'])){
                        $arrayName['id_number'] = "STAFF/".$faker->unique()->numberBetween(1000, 9999)."/0".random_int(6, 11);
                    }
                    $arrayName['password'] = Hash::make($pass);
                    $arrayName['initial_password'] = $pass;
                    $arrayName['remember_token'] = str_random(10);
                    if($type=="employee"){
                        if (Employee::where('id_number',$arrayName['id_number'])->count()!=0 ) {
                            $nowresponse ="Duplicate id_number of ".$arrayName['name']." ";
                            array_push($theresponse["error"], $nowresponse);
                        }elseif(Employee::where('email',$arrayName['email'])->count()!=0){
                            $nowresponse ="Duplicate email of ".$arrayName['name']." ";
                            array_push($theresponse["error"], $nowresponse);
                        }else{
                            Employee::create($arrayName);
                            $nowresponse =$arrayName['name']." successfully imported";
                            array_push($theresponse["success"], $nowresponse);
                        }
                    }else{
                        Student::create($arrayName);
                    }
                }
            }
        }
        return $theresponse;
    }

}