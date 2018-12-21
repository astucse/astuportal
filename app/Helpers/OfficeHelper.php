<?php
use PhpOffice\PhpWord\PhpWord;
namespace App\Helpers;
class OfficeHelper {
	// $fillables = $model[0]->getFillable();
 //        $spreadsheet = new Spreadsheet();
 //        $spreadsheet->getProperties()->setCreator('ASTU PORTAL')
 //            ->setLastModifiedBy('ASTU PORTAL')
 //            ->setTitle('Office 2007 XLSX Test Document')
 //            ->setSubject('Office 2007 XLSX Test Document')
 //            ->setDescription('Student data')
 //            ->setKeywords('office 2007 openxml php')
 //            ->setCategory('Test result file');

 //        foreach ($fillables as $kk => $fillable) {
 //            $spreadsheet->setActiveSheetIndex(0)
 //                        ->setCellValue(chr(65 + $kk). 1, $fillable);
 //        }
 //        foreach ($model as $k => $s) {
 //            foreach ($fillables as $kk => $fillable) {
 //                $spreadsheet->setActiveSheetIndex(0)
 //                            ->setCellValue(chr(65 + $kk). ($k+2), $s[$fillable]);
 //            }            
 //        }
 //        $spreadsheet->getActiveSheet()->setTitle($type.'s');
 //        $spreadsheet->setActiveSheetIndex(0);
 //        $writer = IOFactory::createWriter($spreadsheet, "Xlsx");
 //        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 //        header('Content-Disposition: attachment; filename="'.$type.'s.xlsx"');
 //        $writer->save("php://output");
    public static function word($title,$content){
    	$phpWord = new \PhpOffice\PhpWord\PhpWord();	
        $section = $phpWord->addSection();
        // $text = $section->addText($request->get('name'));
        // $text = $section->addText($request->get('email'));
        // $text = $section->addText($request->get('number'),array('name'=>'Arial','size' => 20,'bold' => true));
        // $section->addImage("./images/Krunal.jpg");  
        // $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
        // $objWriter->save('Appdividend.html');
        // return response()->download(public_path('Appdividend.html'));

        $writer = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, "Word2007");
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header("Content-Disposition: attachment; filename='ejemplo.docx'");
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment; filename="'.$title.'s.docx"');
        return $writer->save("php://output");
	}
}