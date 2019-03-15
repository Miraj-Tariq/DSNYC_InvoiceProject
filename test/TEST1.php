<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 10/13/2018
 * Time: 4:21 PM
 */

require '../vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\IOFactory;
//use PhpOffice\PhpSpreadsheet\Reader\IReader;
use PhpOffice\PhpSpreadsheet;


$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("../Data/sample.xlsx");

//$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("../Data/sample.xlsx");
//$reader->load("../Data/sample.xlsx");
$spreadsheet->setActiveSheetIndex(0);
$spreadsheet->getActiveSheet()->setCellValue("F10", "11");

$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Logo');
$drawing->setPath('../Images/invLogo.PNG');
$drawing->setHeight(75);
$drawing->setCoordinates('A1');
$drawing->setWorksheet($spreadsheet->getActiveSheet());

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
//$writer->setPreCalculateFormulas(false);
$writer->save("../Data/sample.xlsx");








/*
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
*/


?>