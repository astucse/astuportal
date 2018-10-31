<?php
namespace App\Helpers;


use App\Models\Admin;
use App\Models\School;
use App\Models\Student;
use App\Models\Employee;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportExport {
    public static function export($type){
        if($type=="student"){
            $model = Student::all();
            $fillables = Student::inRandomOrder()->get()[0]->getFillable();
        }
        elseif($type=="employee"){
            $model = Employee::all();
            $fillables = Employee::inRandomOrder()->get()[0]->getFillable();
        }
        // return $fillables;
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
    public static function super_import(Request $request, $type){
        $extension = $request->zzzz->extension();
        if ($extension == "bin" || $extension == "xlsx" || $extension == "xls" || $extension == "csv") {
            $path = $request->zzzz->getRealPath();
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet = $reader->load($path);
            $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
            foreach ($sheetData as $row) {
                // print_r($row);
                echo '["year"=>5, "name" => "'.$row['A'].'", "sex"=>"'.$row['C'][0].'", "id"=>"'.$row['B'].'"],';
                // echo $row['A'].$row['B'].$row['C'];
                // echo "<br>";
                // echo "<br>";
            }
            // dd($sheetData);
            // return "|";
        }
        return $extension;
    }

}