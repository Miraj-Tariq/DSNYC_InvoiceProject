<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/22/2018
 * Time: 7:54 PM
 */

require '../vendor/autoload.php';

include("connection.php");

session_start();

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet;

$prodDesc = [];

// TOTAL NUMBER OF PRODUCTS
$noOfProducts = count($_SESSION['productsMemory']);

$line = 0;
$productLines = [];

for ($ct = 0; $ct < $noOfProducts; $ct++){
    $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_SESSION['productsMemory'][$ct]['dsx'] . '"');
    $tempLines = 0;
    while ($row = mysqli_fetch_assoc($res)){
        $line = $line + 3;              // ASSUMING EACH PRODUCT HAS ITEM NO, NAME AND HTSUS NO
        $tempLines = $tempLines + 3;
        if(!empty($row['MATERIAL'])){
            $line++;
            $tempLines++;
        }
        if(!empty($row['DESC 1'])){
            $line++;
            $tempLines++;
        }
        if(!empty($row['DESC 2'])){
            $line++;
            $tempLines++;
        }
        if(!empty($row['DESC 3'])){
            $line++;
            $tempLines++;
        }
        if(!empty($row['DESC 4'])){
            $line++;
            $tempLines++;
        }

        $productLines[] = $tempLines;
    }
}

if ($line < 21){
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("../Data/InvoicePg1.xlsx");
}
else{
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("../Data/InvoicePg2.xlsx");
}


//$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("../Data/sample.xlsx");
//$reader->load("../Data/sample.xlsx");

$spreadsheet->setActiveSheetIndex(0);

/*
$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../Images/invLogo.PNG');
$drawing->setHeight(100);
$drawing->setCoordinates('A1');
$drawing->setWorksheet($spreadsheet->getActiveSheet());
*/

$spreadsheet->getActiveSheet()->setCellValue("A8", $_POST['invoiceDate']);
$spreadsheet->getActiveSheet()->setCellValue("C8", $_SESSION['tos']);
$spreadsheet->getActiveSheet()->setCellValue("D8", $_SESSION['tosLocation']);
$spreadsheet->getActiveSheet()->setCellValue("F8", $_POST['custPONO']);
$spreadsheet->getActiveSheet()->setCellValue("H8", $_POST['invoiceNo']);
$spreadsheet->getActiveSheet()->setCellValue("A16", $_SESSION['shippingCountry']);

$spreadsheet->getActiveSheet()->setCellValue("F10", $_SESSION['shippingName']);
$spreadsheet->getActiveSheet()->setCellValue("F11", $_SESSION['shippingAdd1']);
$spreadsheet->getActiveSheet()->setCellValue("F12", $_SESSION['shippingAdd2']);
$spreadsheet->getActiveSheet()->setCellValue("F13", $_SESSION['shippingAdd3']);
$spreadsheet->getActiveSheet()->setCellValue("F14", $_SESSION['shippingCountry']);

$spreadsheet->getActiveSheet()->setCellValue("F16", $_SESSION['billingName']);
$spreadsheet->getActiveSheet()->setCellValue("F17", $_SESSION['billingAdd1']);
$spreadsheet->getActiveSheet()->setCellValue("F18", $_SESSION['billingAdd2']);
$spreadsheet->getActiveSheet()->setCellValue("F19", $_SESSION['billingAdd3']);
$spreadsheet->getActiveSheet()->setCellValue("F20", $_SESSION['billingCountry']);

$spreadsheet->getActiveSheet()->setCellValue("A20", $_POST['shipVia']);

if ($_POST['shipper'] == '0'){
    $spreadsheet->getActiveSheet()->setCellValue("I1", 'Design & Source (China) Limited');
    $spreadsheet->getActiveSheet()->setCellValue("I2", 'Room 812, South Tower');
    $spreadsheet->getActiveSheet()->setCellValue("I3", 'The Hub NO. 1068, Xin Gang Dong Rd');
    $spreadsheet->getActiveSheet()->setCellValue("I4", 'Guangzhou 510335');
    $spreadsheet->getActiveSheet()->setCellValue("I5", 'China');

    $spreadsheet->getActiveSheet()->setCellValue("A10", 'Design & Source (China) Limited');
    $spreadsheet->getActiveSheet()->setCellValue("A11", 'Room 812, South Tower');
    $spreadsheet->getActiveSheet()->setCellValue("A12", 'The Hub NO. 1068, Xin Gang Dong Rd');
    $spreadsheet->getActiveSheet()->setCellValue("A13", 'Guangzhou 510335');
    $spreadsheet->getActiveSheet()->setCellValue("A14", 'China');
}
else{
    $spreadsheet->getActiveSheet()->setCellValue("I1", 'Design & Source Productions, Inc.');
    $spreadsheet->getActiveSheet()->setCellValue("I2", '143 West 29th Street');
    $spreadsheet->getActiveSheet()->setCellValue("I3", 'Floor 3 New York');
    $spreadsheet->getActiveSheet()->setCellValue("I4", 'NY 10001');
    $spreadsheet->getActiveSheet()->setCellValue("I5", 'USA');

    $spreadsheet->getActiveSheet()->setCellValue("A10", 'Design & Source Productions, Inc.');
    $spreadsheet->getActiveSheet()->setCellValue("A11", '143 West 29th Street');
    $spreadsheet->getActiveSheet()->setCellValue("A12", 'Floor 3 New York');
    $spreadsheet->getActiveSheet()->setCellValue("A13", 'NY 10001');
    $spreadsheet->getActiveSheet()->setCellValue("A14", 'USA');
}

if ($line > 20){
    $spreadsheet->getActiveSheet()->setCellValue("A58", $_POST['invoiceDate']);
    $spreadsheet->getActiveSheet()->setCellValue("C58", $_SESSION['tos']);
    $spreadsheet->getActiveSheet()->setCellValue("D58", $_SESSION['tosLocation']);
    $spreadsheet->getActiveSheet()->setCellValue("F58", $_POST['custPONO']);
    $spreadsheet->getActiveSheet()->setCellValue("H58", $_POST['invoiceNo']);
    $spreadsheet->getActiveSheet()->setCellValue("A66", $_SESSION['shippingCountry']);

    $spreadsheet->getActiveSheet()->setCellValue("F60", $_SESSION['shippingName']);
    $spreadsheet->getActiveSheet()->setCellValue("F61", $_SESSION['shippingAdd1']);
    $spreadsheet->getActiveSheet()->setCellValue("F62", $_SESSION['shippingAdd2']);
    $spreadsheet->getActiveSheet()->setCellValue("F63", $_SESSION['shippingAdd3']);
    $spreadsheet->getActiveSheet()->setCellValue("F64", $_SESSION['shippingCountry']);

    $spreadsheet->getActiveSheet()->setCellValue("F66", $_SESSION['billingName']);
    $spreadsheet->getActiveSheet()->setCellValue("F67", $_SESSION['billingAdd1']);
    $spreadsheet->getActiveSheet()->setCellValue("F68", $_SESSION['billingAdd2']);
    $spreadsheet->getActiveSheet()->setCellValue("F69", $_SESSION['billingAdd3']);
    $spreadsheet->getActiveSheet()->setCellValue("F70", $_SESSION['billingCountry']);

    $spreadsheet->getActiveSheet()->setCellValue("A70", $_POST['shipVia']);

    if ($_POST['shipper'] == '0'){
        $spreadsheet->getActiveSheet()->setCellValue("I51", 'Design & Source (China) Limited');
        $spreadsheet->getActiveSheet()->setCellValue("I52", 'Room 812, South Tower');
        $spreadsheet->getActiveSheet()->setCellValue("I53", 'The Hub NO. 1068, Xin Gang Dong Rd');
        $spreadsheet->getActiveSheet()->setCellValue("I54", 'Guangzhou 510335');
        $spreadsheet->getActiveSheet()->setCellValue("I55", 'China');

        $spreadsheet->getActiveSheet()->setCellValue("A60", 'Design & Source (China) Limited');
        $spreadsheet->getActiveSheet()->setCellValue("A61", 'Room 812, South Tower');
        $spreadsheet->getActiveSheet()->setCellValue("A62", 'The Hub NO. 1068, Xin Gang Dong Rd');
        $spreadsheet->getActiveSheet()->setCellValue("A63", 'Guangzhou 510335');
        $spreadsheet->getActiveSheet()->setCellValue("A64", 'China');
    }
    else{
        $spreadsheet->getActiveSheet()->setCellValue("I51", 'Design & Source Productions, Inc.');
        $spreadsheet->getActiveSheet()->setCellValue("I52", '143 West 29th Street');
        $spreadsheet->getActiveSheet()->setCellValue("I53", 'Floor 3 New York');
        $spreadsheet->getActiveSheet()->setCellValue("I54", 'NY 10001');
        $spreadsheet->getActiveSheet()->setCellValue("I55", 'USA');

        $spreadsheet->getActiveSheet()->setCellValue("A60", 'Design & Source Productions, Inc.');
        $spreadsheet->getActiveSheet()->setCellValue("A61", '143 West 29th Street');
        $spreadsheet->getActiveSheet()->setCellValue("A62", 'Floor 3 New York');
        $spreadsheet->getActiveSheet()->setCellValue("A63", 'NY 10001');
        $spreadsheet->getActiveSheet()->setCellValue("A64", 'USA');
    }
}

$resMarks = mysqli_query($dbc, 'SELECT * FROM customermarks WHERE `CUST ID`="' . $_SESSION['id'] . '"');
$no = 0;
if ($line < 21){
    while ($row = mysqli_fetch_assoc($resMarks)){
        $spreadsheet->getActiveSheet()->setCellValue("A" . (string)(22 + $no), $row['MARKS']);
        $no++;
    }
}
else{
    while ($row = mysqli_fetch_assoc($resMarks)){
        $spreadsheet->getActiveSheet()->setCellValue("A" . (string)(22 + $no), $row['MARKS']);
        $spreadsheet->getActiveSheet()->setCellValue("A" . (string)(72 + $no), $row['MARKS']);
        $no++;
    }
}


if($line < 21){
    $prodLine       = 22;
    $totalPrice     = 0;
    $totalUnits     = 0;
    $totalPackages  = 0;

    $manfAdd1 = '';
    $manfAdd2 = '';
    $manfAdd3 = '';
    $manfAdd4 = '';
    $manfAdd5 = '';

    for($ct = 0; $ct < $noOfProducts; $ct++){
        $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_SESSION['productsMemory'][$ct]['dsx'] . '"');
        while ($row = mysqli_fetch_assoc($res)){
            $totalPrice     = $totalPrice + ($row['PRICE'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalUnits     = $totalUnits + $_SESSION['productsMemory'][$ct]['quantity'];
            $totalPackages  = $totalPackages + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);

            if($ct == 0){
                $manfAdd1 = $row['MANUFACTURER NAME'];
                $manfAdd2 = $row['ADDRESS 1'];
                $manfAdd3 = $row['ADDRESS 2'];
                $manfAdd4 = $row['ADDRESS 3'];
                $manfAdd5 = $row['COUNTRY'];

                $spreadsheet->getActiveSheet()->setCellValue("A18", $manfAdd5);
            }


            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST ITEM NO']);
            $spreadsheet->getActiveSheet()->setCellValue("D" . (string)$prodLine, ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']));
            $spreadsheet->getActiveSheet()->setCellValue("G" . (string)$prodLine, $_SESSION['productsMemory'][$ct]['quantity']);
            $spreadsheet->getActiveSheet()->setCellValue("H" . (string)$prodLine, number_format($row['PRICE'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("I" . (string)$prodLine, number_format($row['PRICE'] * $_SESSION['productsMemory'][$ct]['quantity'], 2, '.', ','));
            $prodLine++;

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST PO DESC']);
            $prodLine++;

            if (!empty($row['MATERIAL'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['MATERIAL']);
                $prodLine++;
            }
            if (!empty($row['DESC 1'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 1']);
                $prodLine++;
            }
            if (!empty($row['DESC 2'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 2']);
                $prodLine++;
            }
            if (!empty($row['DESC 3'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 3']);
                $prodLine++;
            }
            if (!empty($row['DESC 4'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 4']);
                $prodLine++;
            }

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['HTSUS NO']);
            $prodLine++;
        }
    }

    $spreadsheet->getActiveSheet()->setCellValue("I43", number_format($totalPrice, 2, '.', ','));
    $spreadsheet->getActiveSheet()->setCellValue("I45", number_format($totalPrice, 2, '.', ','));
    $spreadsheet->getActiveSheet()->setCellValue("I44", '0');
    $spreadsheet->getActiveSheet()->setCellValue("A46", $totalPackages);
    $spreadsheet->getActiveSheet()->setCellValue("C46", $totalUnits);

    $spreadsheet->getActiveSheet()->setCellValue("F46", $manfAdd1);
    $spreadsheet->getActiveSheet()->setCellValue("F47", $manfAdd2);
    $spreadsheet->getActiveSheet()->setCellValue("F48", $manfAdd3 . ', ' . $manfAdd4);
    $spreadsheet->getActiveSheet()->setCellValue("F49", $manfAdd5);

}
else{
    $prodLine       = 22;
    $totalPrice     = 0;
    $totalUnits     = 0;
    $totalPackages  = 0;

    $manfAdd1 = '';
    $manfAdd2 = '';
    $manfAdd3 = '';
    $manfAdd4 = '';
    $manfAdd5 = '';

    $pg1Prods = 0;
    $pg2Prods = 0;
    $temp2 = 0;
    for ($ct = 0; $ct < $noOfProducts; $ct++){
        $temp2 = $temp2 + $productLines[$ct];
        if ($temp2 < 21){
            $pg1Prods++;
        }
        else{
            $pg2Prods = $noOfProducts - $pg1Prods;
            break;
        }
    }

    for($ct = 0; $ct < $pg1Prods; $ct++){
        $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_SESSION['productsMemory'][$ct]['dsx'] . '"');
        while ($row = mysqli_fetch_assoc($res)){
            $totalPrice     = $totalPrice + ($row['PRICE'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalUnits     = $totalUnits + $_SESSION['productsMemory'][$ct]['quantity'];
            $totalPackages  = $totalPackages + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);

            if($ct == 0){
                $manfAdd1 = $row['MANUFACTURER NAME'];
                $manfAdd2 = $row['ADDRESS 1'];
                $manfAdd3 = $row['ADDRESS 2'];
                $manfAdd4 = $row['ADDRESS 3'];
                $manfAdd5 = $row['COUNTRY'];

                $spreadsheet->getActiveSheet()->setCellValue("A18", $manfAdd5);
            }


            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST ITEM NO']);
            $spreadsheet->getActiveSheet()->setCellValue("D" . (string)$prodLine, ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']));
            $spreadsheet->getActiveSheet()->setCellValue("G" . (string)$prodLine, $_SESSION['productsMemory'][$ct]['quantity']);
            $spreadsheet->getActiveSheet()->setCellValue("H" . (string)$prodLine, number_format($row['PRICE'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("I" . (string)$prodLine, number_format($row['PRICE'] * $_SESSION['productsMemory'][$ct]['quantity'], 2, '.', ','));
            $prodLine++;

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST PO DESC']);
            $prodLine++;

            if (!empty($row['MATERIAL'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['MATERIAL']);
                $prodLine++;
            }
            if (!empty($row['DESC 1'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 1']);
                $prodLine++;
            }
            if (!empty($row['DESC 2'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 2']);
                $prodLine++;
            }
            if (!empty($row['DESC 3'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 3']);
                $prodLine++;
            }
            if (!empty($row['DESC 4'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 4']);
                $prodLine++;
            }

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['HTSUS NO']);
            $prodLine++;
        }
    }

    $prodLine = 72;

    for($ct = $pg1Prods; $ct < $pg2Prods; $ct++){
        $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_SESSION['productsMemory'][$ct]['dsx'] . '"');
        while ($row = mysqli_fetch_assoc($res)){
            $totalPrice     = $totalPrice + ($row['PRICE'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalUnits     = $totalUnits + $_SESSION['productsMemory'][$ct]['quantity'];
            $totalPackages  = $totalPackages + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST ITEM NO']);
            $spreadsheet->getActiveSheet()->setCellValue("D" . (string)$prodLine, ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']));
            $spreadsheet->getActiveSheet()->setCellValue("G" . (string)$prodLine, $_SESSION['productsMemory'][$ct]['quantity']);
            $spreadsheet->getActiveSheet()->setCellValue("H" . (string)$prodLine, number_format($row['PRICE'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("I" . (string)$prodLine, number_format($row['PRICE'] * $_SESSION['productsMemory'][$ct]['quantity'], 2, '.', ','));
            $prodLine++;

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST PO DESC']);
            $prodLine++;

            if (!empty($row['MATERIAL'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['MATERIAL']);
                $prodLine++;
            }
            if (!empty($row['DESC 1'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 1']);
                $prodLine++;
            }
            if (!empty($row['DESC 2'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 2']);
                $prodLine++;
            }
            if (!empty($row['DESC 3'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 3']);
                $prodLine++;
            }
            if (!empty($row['DESC 4'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 4']);
                $prodLine++;
            }

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['HTSUS NO']);
            $prodLine++;
        }
    }

    $spreadsheet->getActiveSheet()->setCellValue("I93", number_format($totalPrice, 2, '.', ','));
    $spreadsheet->getActiveSheet()->setCellValue("I95", number_format($totalPrice, 2, '.', ','));
    $spreadsheet->getActiveSheet()->setCellValue("I94", '0');
    $spreadsheet->getActiveSheet()->setCellValue("A96", $totalPackages);
    $spreadsheet->getActiveSheet()->setCellValue("C96", $totalUnits);

    $spreadsheet->getActiveSheet()->setCellValue("F96", $manfAdd1);
    $spreadsheet->getActiveSheet()->setCellValue("F97", $manfAdd2);
    $spreadsheet->getActiveSheet()->setCellValue("F98", $manfAdd3 . ', ' . $manfAdd4);
    $spreadsheet->getActiveSheet()->setCellValue("F99", $manfAdd5);
}

unlink("../Data/Invoice&PackingList/Invoice.xlsx");

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
//$writer->setPreCalculateFormulas(false);
$writer->save("../Data/Invoice&PackingList/Invoice.xlsx");








if ($line < 21){
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("../Data/PackingListPg1.xlsx");
}
else{
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load("../Data/PackingListPg2.xlsx");
}

//$reader = PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile("../Data/sample.xlsx");
//$reader->load("../Data/sample.xlsx");

$spreadsheet->setActiveSheetIndex(0);

$spreadsheet->getActiveSheet()->setCellValue("A8", $_POST['invoiceDate']);
$spreadsheet->getActiveSheet()->setCellValue("C8", $_SESSION['tos']);
$spreadsheet->getActiveSheet()->setCellValue("D8", $_SESSION['tosLocation']);
$spreadsheet->getActiveSheet()->setCellValue("F8", $_POST['custPONO']);
$spreadsheet->getActiveSheet()->setCellValue("H8", $_POST['invoiceNo']);
$spreadsheet->getActiveSheet()->setCellValue("G16", $_SESSION['shippingCountry']);
$spreadsheet->getActiveSheet()->setCellValue("A16", $_POST['shipVia']);

$spreadsheet->getActiveSheet()->setCellValue("F10", $_SESSION['shippingName']);
$spreadsheet->getActiveSheet()->setCellValue("F11", $_SESSION['shippingAdd1']);
$spreadsheet->getActiveSheet()->setCellValue("F12", $_SESSION['shippingAdd2']);
$spreadsheet->getActiveSheet()->setCellValue("F13", $_SESSION['shippingAdd3']);
$spreadsheet->getActiveSheet()->setCellValue("F14", $_SESSION['shippingCountry']);

if ($_POST['shipper'] == '0'){
    $spreadsheet->getActiveSheet()->setCellValue("I1", 'Design & Source (China) Limited');
    $spreadsheet->getActiveSheet()->setCellValue("I2", 'Room 812, South Tower');
    $spreadsheet->getActiveSheet()->setCellValue("I3", 'The Hub NO. 1068, Xin Gang Dong Rd');
    $spreadsheet->getActiveSheet()->setCellValue("I4", 'Guangzhou 510335');
    $spreadsheet->getActiveSheet()->setCellValue("I5", 'China');

    $spreadsheet->getActiveSheet()->setCellValue("A10", 'Design & Source (China) Limited');
    $spreadsheet->getActiveSheet()->setCellValue("A11", 'Room 812, South Tower');
    $spreadsheet->getActiveSheet()->setCellValue("A12", 'The Hub NO. 1068, Xin Gang Dong Rd');
    $spreadsheet->getActiveSheet()->setCellValue("A13", 'Guangzhou 510335');
    $spreadsheet->getActiveSheet()->setCellValue("A14", 'China');

    $spreadsheet->getActiveSheet()->setCellValue("D16", 'China');
}
else{
    $spreadsheet->getActiveSheet()->setCellValue("I1", 'Design & Source Productions, Inc.');
    $spreadsheet->getActiveSheet()->setCellValue("I2", '143 West 29th Street');
    $spreadsheet->getActiveSheet()->setCellValue("I3", 'Floor 3 New York');
    $spreadsheet->getActiveSheet()->setCellValue("I4", 'NY 10001');
    $spreadsheet->getActiveSheet()->setCellValue("I5", 'USA');

    $spreadsheet->getActiveSheet()->setCellValue("A10", 'Design & Source Productions, Inc.');
    $spreadsheet->getActiveSheet()->setCellValue("A11", '143 West 29th Street');
    $spreadsheet->getActiveSheet()->setCellValue("A12", 'Floor 3 New York');
    $spreadsheet->getActiveSheet()->setCellValue("A13", 'NY 10001');
    $spreadsheet->getActiveSheet()->setCellValue("A14", 'USA');

    $spreadsheet->getActiveSheet()->setCellValue("D16", 'USA');
}

if ($line > 20){
    $spreadsheet->getActiveSheet()->setCellValue("A60", $_POST['invoiceDate']);
    $spreadsheet->getActiveSheet()->setCellValue("C60", $_SESSION['tos']);
    $spreadsheet->getActiveSheet()->setCellValue("D60", $_SESSION['tosLocation']);
    $spreadsheet->getActiveSheet()->setCellValue("F60", $_POST['custPONO']);
    $spreadsheet->getActiveSheet()->setCellValue("H60", $_POST['invoiceNo']);
    $spreadsheet->getActiveSheet()->setCellValue("G68", $_SESSION['shippingCountry']);
    $spreadsheet->getActiveSheet()->setCellValue("A68", $_POST['shipVia']);

    $spreadsheet->getActiveSheet()->setCellValue("F62", $_SESSION['shippingName']);
    $spreadsheet->getActiveSheet()->setCellValue("F63", $_SESSION['shippingAdd1']);
    $spreadsheet->getActiveSheet()->setCellValue("F64", $_SESSION['shippingAdd2']);
    $spreadsheet->getActiveSheet()->setCellValue("F65", $_SESSION['shippingAdd3']);
    $spreadsheet->getActiveSheet()->setCellValue("F66", $_SESSION['shippingCountry']);

    if ($_POST['shipper'] == '0'){
        $spreadsheet->getActiveSheet()->setCellValue("I53", 'Design & Source (China) Limited');
        $spreadsheet->getActiveSheet()->setCellValue("I54", 'Room 812, South Tower');
        $spreadsheet->getActiveSheet()->setCellValue("I55", 'The Hub NO. 1068, Xin Gang Dong Rd');
        $spreadsheet->getActiveSheet()->setCellValue("I56", 'Guangzhou 510335');
        $spreadsheet->getActiveSheet()->setCellValue("I57", 'China');

        $spreadsheet->getActiveSheet()->setCellValue("A62", 'Design & Source (China) Limited');
        $spreadsheet->getActiveSheet()->setCellValue("A63", 'Room 812, South Tower');
        $spreadsheet->getActiveSheet()->setCellValue("A64", 'The Hub NO. 1068, Xin Gang Dong Rd');
        $spreadsheet->getActiveSheet()->setCellValue("A65", 'Guangzhou 510335');
        $spreadsheet->getActiveSheet()->setCellValue("A66", 'China');

        $spreadsheet->getActiveSheet()->setCellValue("D68", 'China');
    }
    else{
        $spreadsheet->getActiveSheet()->setCellValue("I53", 'Design & Source Productions, Inc.');
        $spreadsheet->getActiveSheet()->setCellValue("I54", '143 West 29th Street');
        $spreadsheet->getActiveSheet()->setCellValue("I55", 'Floor 3 New York');
        $spreadsheet->getActiveSheet()->setCellValue("I56", 'NY 10001');
        $spreadsheet->getActiveSheet()->setCellValue("I57", 'USA');

        $spreadsheet->getActiveSheet()->setCellValue("A62", 'Design & Source Productions, Inc.');
        $spreadsheet->getActiveSheet()->setCellValue("A63", '143 West 29th Street');
        $spreadsheet->getActiveSheet()->setCellValue("A64", 'Floor 3 New York');
        $spreadsheet->getActiveSheet()->setCellValue("A65", 'NY 10001');
        $spreadsheet->getActiveSheet()->setCellValue("A66", 'USA');

        $spreadsheet->getActiveSheet()->setCellValue("D68", 'USA');
    }
}

$resMarks = mysqli_query($dbc, 'SELECT * FROM customermarks WHERE `CUST ID`="' . $_SESSION['id'] . '"');
$no = 0;
if ($line < 21){
    while ($row = mysqli_fetch_assoc($resMarks)){
        $spreadsheet->getActiveSheet()->setCellValue("A" . (string)(18 + $no), $row['MARKS']);
        $no++;
    }
}
else{
    while ($row = mysqli_fetch_assoc($resMarks)){
        $spreadsheet->getActiveSheet()->setCellValue("A" . (string)(18 + $no), $row['MARKS']);
        $spreadsheet->getActiveSheet()->setCellValue("A" . (string)(70 + $no), $row['MARKS']);
        $no++;
    }
}

if($line < 21){
    $prodLine           = 18;
    $totalPackages      = 0;
    $totalCartons       = 0;
    $totalUnits         = 0;
    $totalGrossWt       = 0;
    $totalNetWt         = 0;
    $totalCBM           = 0;

    for($ct = 0; $ct < $noOfProducts; $ct++){
        $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_SESSION['productsMemory'][$ct]['dsx'] . '"');
        while ($row = mysqli_fetch_assoc($res)){
            $totalUnits     = $totalUnits + $_SESSION['productsMemory'][$ct]['quantity'];
            $totalPackages  = $totalPackages + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);
            $totalCartons   = $totalCartons + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);
            $totalGrossWt   = $totalGrossWt + ($row['GROSS WT'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalNetWt     = $totalNetWt + ($row['NET WT'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalCBM       = $totalCBM + ((($row['DIM L'] * $row['DIM W'] * $row['DIM H']) / 1000000) * (ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY'])));

            $spreadsheet->getActiveSheet()->setCellValue("C" . (string)$prodLine, (string)ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']) . ' Cartons');
            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST ITEM NO']);
            $spreadsheet->getActiveSheet()->setCellValue("G" . (string)$prodLine, number_format($row['GROSS WT'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("H" . (string)$prodLine, number_format($row['NET WT'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("I" . (string)$prodLine, (string)$row['DIM L'] . ' x ' . (string)$row['DIM W'] . ' x ' . (string)$row['DIM H']);
            $prodLine++;

            $spreadsheet->getActiveSheet()->setCellValue("C" . (string)$prodLine, (string)$row['QUANTITY'] . ' Pcs/Ctn');
            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST PO DESC']);
            $prodLine++;

            if (!empty($row['MATERIAL'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['MATERIAL']);
                $prodLine++;
            }
            if (!empty($row['DESC 1'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 1']);
                $prodLine++;
            }
            if (!empty($row['DESC 2'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 2']);
                $prodLine++;
            }
            if (!empty($row['DESC 3'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 3']);
                $prodLine++;
            }
            if (!empty($row['DESC 4'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 4']);
                $prodLine++;
            }

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['HTSUS NO']);
            $spreadsheet->getActiveSheet()->setCellValue("C" . (string)$prodLine,'Ctn # 1-' . ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']));
            $prodLine++;
        }
    }

    $spreadsheet->getActiveSheet()->setCellValue("A45", $totalPackages);
    $spreadsheet->getActiveSheet()->setCellValue("C45", $totalCartons);
    $spreadsheet->getActiveSheet()->setCellValue("F45", $totalUnits);
    $spreadsheet->getActiveSheet()->setCellValue("G45", $totalGrossWt);
    $spreadsheet->getActiveSheet()->setCellValue("H45", $totalNetWt);
    $spreadsheet->getActiveSheet()->setCellValue("I45", $totalCBM);
}
else{
    $prodLine           = 18;
    $totalPackages      = 0;
    $totalCartons       = 0;
    $totalUnits         = 0;
    $totalGrossWt       = 0;
    $totalNetWt         = 0;
    $totalCBM           = 0;

    $pg1Prods = 0;
    $pg2Prods = 0;
    $temp2 = 0;
    for ($ct = 0; $ct < $noOfProducts; $ct++){
        $temp2 = $temp2 + $productLines[$ct];
        if ($temp2 < 21){
            $pg1Prods++;
        }
        else{
            $pg2Prods = $noOfProducts - $pg1Prods;
            break;
        }
    }

    for($ct = 0; $ct < $pg1Prods; $ct++){
        $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_SESSION['productsMemory'][$ct]['dsx'] . '"');
        while ($row = mysqli_fetch_assoc($res)){
            $totalUnits     = $totalUnits + $_SESSION['productsMemory'][$ct]['quantity'];
            $totalPackages  = $totalPackages + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);
            $totalCartons   = $totalCartons + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);
            $totalGrossWt   = $totalGrossWt + ($row['GROSS WT'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalNetWt     = $totalNetWt + ($row['NET WT'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalCBM       = $totalCBM + ((($row['DIM L'] * $row['DIM W'] * $row['DIM H']) / 1000000) * (ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY'])));

            $spreadsheet->getActiveSheet()->setCellValue("C" . (string)$prodLine, (string)ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']) . ' Cartons');
            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST ITEM NO']);
            $spreadsheet->getActiveSheet()->setCellValue("G" . (string)$prodLine, number_format($row['GROSS WT'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("H" . (string)$prodLine, number_format($row['NET WT'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("I" . (string)$prodLine, (string)$row['DIM L'] . ' x ' . (string)$row['DIM W'] . ' x ' . (string)$row['DIM H']);
            $prodLine++;

            $spreadsheet->getActiveSheet()->setCellValue("C" . (string)$prodLine, (string)$row['QUANTITY'] . ' Pcs/Ctn');
            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST PO DESC']);
            $prodLine++;

            if (!empty($row['MATERIAL'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['MATERIAL']);
                $prodLine++;
            }
            if (!empty($row['DESC 1'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 1']);
                $prodLine++;
            }
            if (!empty($row['DESC 2'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 2']);
                $prodLine++;
            }
            if (!empty($row['DESC 3'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 3']);
                $prodLine++;
            }
            if (!empty($row['DESC 4'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 4']);
                $prodLine++;
            }

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['HTSUS NO']);
            $spreadsheet->getActiveSheet()->setCellValue("C" . 'Ctn # 1-' . ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']));
            $prodLine++;
        }
    }

    $prodLine = 70;

    for($ct = $pg1Prods; $ct < $pg2Prods; $ct++){
        $res = mysqli_query($dbc, 'SELECT * FROM products WHERE DSX="' . $_SESSION['productsMemory'][$ct]['dsx'] . '"');
        while ($row = mysqli_fetch_assoc($res)){
            $totalUnits     = $totalUnits + $_SESSION['productsMemory'][$ct]['quantity'];
            $totalPackages  = $totalPackages + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);
            $totalCartons   = $totalCartons + ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']);
            $totalGrossWt   = $totalGrossWt + ($row['GROSS WT'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalNetWt     = $totalNetWt + ($row['NET WT'] * $_SESSION['productsMemory'][$ct]['quantity']);
            $totalCBM       = $totalCBM + ((($row['DIM L'] * $row['DIM W'] * $row['DIM H']) / 1000000) * (ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY'])));

            $spreadsheet->getActiveSheet()->setCellValue("C" . (string)$prodLine, (string)ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']) . ' Cartons');
            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST ITEM NO']);
            $spreadsheet->getActiveSheet()->setCellValue("G" . (string)$prodLine, number_format($row['GROSS WT'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("H" . (string)$prodLine, number_format($row['NET WT'], 2, '.', ','));
            $spreadsheet->getActiveSheet()->setCellValue("I" . (string)$prodLine, (string)$row['DIM L'] . ' x ' . (string)$row['DIM W'] . ' x ' . (string)$row['DIM H']);
            $prodLine++;

            $spreadsheet->getActiveSheet()->setCellValue("C" . (string)$prodLine, (string)$row['QUANTITY'] . ' Pcs/Ctn');
            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['CUST PO DESC']);
            $prodLine++;

            if (!empty($row['MATERIAL'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['MATERIAL']);
                $prodLine++;
            }
            if (!empty($row['DESC 1'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 1']);
                $prodLine++;
            }
            if (!empty($row['DESC 2'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 2']);
                $prodLine++;
            }
            if (!empty($row['DESC 3'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 3']);
                $prodLine++;
            }
            if (!empty($row['DESC 4'])){
                $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['DESC 4']);
                $prodLine++;
            }

            $spreadsheet->getActiveSheet()->setCellValue("F" . (string)$prodLine, $row['HTSUS NO']);
            $spreadsheet->getActiveSheet()->setCellValue("C" . 'Ctn # 1-' . ceil($_SESSION['productsMemory'][$ct]['quantity'] / $row['QUANTITY']));
            $prodLine++;
        }
    }

    $spreadsheet->getActiveSheet()->setCellValue("A94", $totalPackages);
    $spreadsheet->getActiveSheet()->setCellValue("C94", $totalCartons);
    $spreadsheet->getActiveSheet()->setCellValue("F94", $totalUnits);
    $spreadsheet->getActiveSheet()->setCellValue("G94", $totalGrossWt);
    $spreadsheet->getActiveSheet()->setCellValue("H94", $totalNetWt);
    $spreadsheet->getActiveSheet()->setCellValue("I94", $totalCBM);
}

unlink("../Data/Invoice&PackingList/PackingList.xlsx");

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
//$writer->setPreCalculateFormulas(false);
$writer->save("../Data/Invoice&PackingList/PackingList.xlsx");

$invoiceName        = 'Invoice-' . (string)$_POST['invoiceNo'] . '.xlsx';
$packingListName    = 'PackingList-' . (string)$_POST['invoiceNo'] . '.xlsx';

$downloadHTML = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>D&S Generator</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
        .downloadLinks {
            color: #7FBA39;
            font-size: 22px;
            font-weight: bold;
            transition: 0.3s;
        }

        .downloadLinks:hover {
            color: #9F1E61;
            text-decoration: none;
            font-size: 25px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row" style="height: 100px;">

        </div>

        <div class="row">
            <div class="col text-center">
                <a class="downloadLinks" href="Data/Invoice&PackingList/Invoice.xlsx" download="' . $invoiceName . '">DOWNLOAD INVOICE</a>
            </div>
        </div>

        <div class="row" style="height: 50px;">
            
        </div>

        <div class="row">
            <div class="col text-center">
                <a class="downloadLinks" href="Data/Invoice&PackingList/PackingList.xlsx" download="' . $packingListName . '">DOWNLOAD PACKING LIST</a>
            </div>
        </div>
    </div>

</body>
</html>';

$myfile = fopen("../downloadDocs.html", "w") or die("Unable to open file!");
fwrite($myfile, $downloadHTML);
fclose($myfile);

session_destroy();

header('Location: ../downloadDocs.html');

?>