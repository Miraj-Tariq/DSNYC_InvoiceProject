<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/5/2018
 * Time: 1:11 PM
 */

include("connection.php");

session_start();

$customerNames      = array();
$productDSXs        = array();
$productList        = '';
$productsCount      = 0;
$temp               = '';

if(!isset($_SESSION['status'])){
    $_SESSION['status'] = 0;
}
if (!isset($_SESSION['productsCount'])){
    $_SESSION['productsCount'] = 1;
    $productsCount = 1;
}
if (!isset($_SESSION['id'])){
    $_SESSION['id'] = 0;
}

$shipping = $_SESSION['shippingName'];

if(!empty($_SESSION['shippingAdd1'])){
    $shipping = $shipping . ", " . $_SESSION['shippingAdd1'];
}

if(!empty($_SESSION['shippingAdd2'])){
    $shipping = $shipping . ", " . $_SESSION['shippingAdd2'];
}

if(!empty($_SESSION['shippingAdd3'])){
    $shipping = $shipping . ", " . $_SESSION['shippingAdd3'];
}

if(!empty($_SESSION['shippingCountry'])){
    $shipping = $shipping . ", " . $_SESSION['shippingCountry'];
}

if(!empty($_SESSION['shippingAdditional'])){
    $shipping = $shipping . ", " . $_SESSION['shippingAdditional'];
}

$shipping = $shipping . ".";

$billing = $_SESSION['billingName'];

if(!empty($_SESSION['billingAdd1'])){
    $billing = $billing . ", " . $_SESSION['billingAdd1'];
}

if(!empty($_SESSION['billingAdd2'])){
    $billing = $billing . ", " . $_SESSION['billingAdd2'];
}

if(!empty($_SESSION['billingAdd3'])){
    $billing = $billing . ", " . $_SESSION['billingAdd3'];
}

if(!empty($_SESSION['billingCountry'])){
    $billing = $billing . ", " . $_SESSION['billingCountry'];
}

$billing = $billing . ".";

$marks = '';
foreach ($_SESSION['marks'] as $i){
    $marks = $marks . "<li>" . $i . "</li>";
}

if (empty($_SESSION['productsMemory'])){
    $productsCount = 1;
    $productList = '<tr>
                        <td><input class="Input_Text typeaheadP" type="text" name="DSX1" style="width:150px;" placeholder="Ex: 12345"><br><div class="errorDiv" id="DSX1E"></div></td>
                        <td><input class="Input_Text" style="width: 100px;" type="text" name="Quantity1" placeholder="Ex: 10"></td>
                        <td>$&nbsp;&nbsp;<input class="Input_Text priceTag" style="width: 120px;" type="text" name="Price1" placeholder="Ex: 10.5" disabled="disabled">&nbsp;&nbsp;&nbsp;<a href="" onclick="return updatePrice(1);" style="font-size: 12px; font-weight: normal; color: #858585;">Update Price</a></td>
                
                        <td style="display: none;"><label for="def1"><input type="radio" id="def1" name="priceChange1" value="2"></label></td>
                        <td style="text-align: center;"><label for="temp1">&nbsp;&nbsp;Temporary<input type="radio" id="temp1" name="priceChange1" value="0" onclick="return enablePrice(1, \'t\')" style="size: 20px;"></label></td>
                        <td style="text-align: center;"><label for="perm1">&nbsp;&nbsp;Permanent<input type="radio" id="perm1" name="priceChange1" value="1" onclick="return enablePrice(1, \'p\')" style="size: 20px;"></label></td>
                    </tr>';
}
else{
    $prodLen = count($_SESSION['productsMemory']);
    $productsCount = $prodLen;

    for($n = 0; $n < $prodLen; $n++){
        $productList = $productList .
            '<tr>
                <td><input class="Input_Text typeaheadP" type="text" name="DSX' . ($n + 1) . '" style="width:150px;" value="' . $_SESSION['productsMemory'][$n]['dsx'] . '" placeholder="Ex: 12345"><div class="errorDiv" id="DSX' . ($n + 1) . 'E"></div></td>
                <td><input class="Input_Text" style="width: 100px;" type="text" name="Quantity' . ($n + 1) . '" value="' . $_SESSION['productsMemory'][$n]['quantity'] . '" placeholder="Ex: 10"></td>';

        $res = mysqli_query($dbc, 'SELECT PRICE FROM products WHERE DSX="' . $_SESSION['productsMemory'][$n]['dsx'] . '"');

        while ($row = mysqli_fetch_assoc($res)){
            $price = $row['PRICE'];
        }

        if (empty($_SESSION['productsMemory'][$n]['price'])){
            $productList = $productList .
                '<td>$&nbsp;&nbsp;<input class="Input_Text priceTag" style="width: 120px;" type="text" name="Price' . ($n + 1) . '" placeholder="Ex: 10.5" disabled>&nbsp;&nbsp;&nbsp;<a href="" onclick="return updatePrice(' . ($n + 1) . ');" style="font-size: 12px; font-weight: normal; color: #858585;">Update Price</a></td>
                
                 <td style="display: none;"><label for="def' . ($n + 1) . '"><input type="radio" id="def' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="2"></label></td>
                 <td style="text-align: center;"><label for="temp' . ($n + 1) . '">&nbsp;&nbsp;Temporary<input type="radio" id="temp' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="0" onclick="return enablePrice(' . ($n + 1) . ', \'t\')" style="size: 20px;"></label></td>
                 <td style="text-align: center;"><label for="perm' . ($n + 1) . '">&nbsp;&nbsp;Permanent<input type="radio" id="perm' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="1" onclick="return enablePrice(' . ($n + 1) . ', \'p\')" style="size: 20px;"></label></td>';
        }
        elseif ($_SESSION['productsMemory'][$n]['price'] == $price){
            $productList = $productList .
                '<td>$&nbsp;&nbsp;<input class="Input_Text priceTag" style="width: 120px;" type="text" name="Price' . ($n + 1) . '" placeholder="Ex: 10.5" value="' . $price . '" disabled>&nbsp;&nbsp;&nbsp;<a href="" onclick="return updatePrice(' . ($n + 1) . ');" style="font-size: 12px; font-weight: normal; color: #858585;">Update Price</a></td>
                
                <td style="display: none;"><label for="def' . ($n + 1) . '"><input type="radio" id="def' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="2"></label></td>
                <td style="text-align: center;"><label for="temp' . ($n + 1) . '">&nbsp;&nbsp;Temporary<input type="radio" id="temp' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="0" onclick="return enablePrice(' . ($n + 1) . ', \'t\')" style="size: 20px;"></label></td>
                <td style="text-align: center;"><label for="perm' . ($n + 1) . '">&nbsp;&nbsp;Permanent<input type="radio" id="perm' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="1" onclick="return enablePrice(' . ($n + 1) . ', \'p\')" style="size: 20px;"></label></td>';
        }
        elseif ($_SESSION['productsMemory'][$n]['price'] != $price){
            $productList = $productList . '<td>$&nbsp;&nbsp;<input class="Input_Text priceTag" style="width: 120px;" type="text" name="Price' . ($n + 1) . '" placeholder="Ex: 10.5" value="' . $_SESSION['productsMemory'][$n]['price'] . '">&nbsp;&nbsp;&nbsp;<a href="" onclick="return updatePrice(' . ($n + 1) . ');" style="font-size: 12px; font-weight: normal; color: #858585;">Update Price</a></td>';

            if($_SESSION['productsMemory'][$n]['priceChange'] == "0"){
                $productList = $productList .
                    '<td style="display: none;"><label for="def' . ($n + 1) . '"><input type="radio" id="def' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="2"></label></td>
                    <td style="text-align: center;"><label for="temp' . ($n + 1) . '">&nbsp;&nbsp;Temporary<input type="radio" id="temp' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="0" checked="checked" onclick="return enablePrice(' . ($n + 1) . ', \'t\')" style="size: 20px;"></label></td>
                    <td style="text-align: center;"><label for="perm' . ($n + 1) . '">&nbsp;&nbsp;Permanent<input type="radio" id="perm' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="1" onclick="return enablePrice(' . ($n + 1) . ', \'p\')" style="size: 20px;"></label></td>';
            }
            elseif($_SESSION['productsMemory'][$n]['priceChange'] == "1"){
                $productList = $productList .
                    '<td style="display: none;"><label for="def' . ($n + 1) . '"><input type="radio" id="def' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="2"></label></td>
                    <td style="text-align: center;"><label for="temp' . ($n + 1) . '">&nbsp;&nbsp;Temporary<input type="radio" id="temp' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="0" onclick="return enablePrice(' . ($n + 1) . ', \'t\')" style="size: 20px;"></label></td>
                    <td style="text-align: center;"><label for="perm' . ($n + 1) . '">&nbsp;&nbsp;Permanent<input type="radio" id="perm' . ($n + 1) . '" name="priceChange' . ($n + 1) . '" value="1" checked="checked" onclick="return enablePrice(' . ($n + 1) . ', \'p\')" style="size: 20px;"></label></td>';
            }
        }

        $productList = $productList . '</tr>';
    }
}

$result = mysqli_query($dbc, 'SELECT `NAME` FROM customers');

while ($row = mysqli_fetch_assoc($result)){
    $customerNames[] = $row['NAME'];
}

$myfile = fopen("../JSON/customerNames.json", "w") or die("Unable to open file!");
fwrite($myfile, json_encode($customerNames));
fclose($myfile);

if($_SESSION['status'] == 1 or $_SESSION['status'] == 2){
    $result = mysqli_query($dbc, 'SELECT `DSX` FROM products WHERE `CUST ID`=' . $_SESSION['id']);

    while ($row = mysqli_fetch_assoc($result)){
        $productDSXs[] = $row['DSX'];
    }

    $myfile = fopen("../JSON/productDSXs.json", "w") or die("Unable to open file!");
    fwrite($myfile, json_encode($productDSXs));
    fclose($myfile);
}


$generatorHTML = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>D&S Generator</title>
    <link rel="stylesheet" href="CSS/jquery-ui.theme.min.css">
    <link rel="stylesheet" href="CSS/jquery-ui.structure.min.css">
    <script src="JS/jquery.min.js"></script>
    <script src="JS/jQuery-ui.js"></script>
    <script src="JS/typeahead.js"></script>
    
    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/action.js"></script>

    <script>
        $(document).ready(function(){
            var id = ' . $_SESSION['id'] . ';
            if(id != 0){
                $("#productSection :input").attr("disabled", false);
                $("input[name=Price1]").attr("disabled", true);
                $("#productButtons").show();
            }
            else{
                $("#productSection :input").attr("disabled", true);
                $("#productButtons").hide();
            }
            
            var st = ' . $_SESSION["status"]. ';
            if(st == 1){
                $(\'#customerMain\').hide();
                $(\'#oldCustomer\').hide();
                $(\'#oldCustomerPreview\').hide();
                $(\'#preview_section\').show();
            }
            if(st == 2){
                $(\'#customerMain\').hide();
                $(\'#oldCustomer\').hide();
                $(\'#oldCustomerPreview\').show();
                $(\'#preview_section\').show();
            }
        });

    </script>
    

</head>
<body>
<div id="pageTitle">
    <a href="PHP/reset.php" style="text-decoration: none;" ><span class="purple">INVOICE</span> <span class="green">AND</span> <span class="purple">PACKING</span> <span class="green">LIST</span> <span class="purple">GENERATOR</span></a>
</div>

<form method="post" action="PHP/generate.php">
    <div class="form_section">
        <div class="form_section_heading">
            CUSTOMER INFORMATION
        </div>

        <table id="customerMain"  style="display: table;">
            <colgroup>
                <col style="width: 50%">
                <col style="width: 50%">
            </colgroup>
            <tr>
                <td style="text-align: center;"><a class="button smallBtn" href="Register-Customer.html" >NEW CUSTOMER</a></td>
                <td style="text-align: center;"><button class="button smallBtn" onclick="return showOldCustomer();">EXISTING CUSTOMER</button></td>
            </tr>
        </table>

        <table id="gif-Load" style="display: none;">
            <tr>
                <td style="text-align:center; height:80px;"><img src="OTHER/ajax-loader.gif"></td>
            </tr>
        </table>

        <table id="oldCustomer" style="display: none;">
            <colgroup>
                <col style="width: 50%;">
                <col style="width: 50%;">
            </colgroup>
            <tr>
                <th>Customer Name</th>
                <th>Shipping Info</th>
            </tr>
            <tr>
                <td>
                    <input class="Input_Text typeaheadC" type="text" id="Cust_Name" name="Cust_Name" placeholder="Ex: NYPD Equipment Section">
                    <br>
                    <div class="errorDiv" id="Cust_NameE"></div>
                </td>
                <td>
                    <select class="Input_Select" id="Cust_Shipping" name="Ship_Info" disabled>
                    </select>
                    &nbsp;&nbsp;
                    <a href="" onclick=" return populateShipping();" style="font-size: 12px; font-weight: normal; color: #858585;">Populate Shipping Info</a>
                </td>
            </tr>
            <tr id="previewOldCustomer" style="display: none;">
                <td style="text-align: center; padding-top:10px;" colspan="2">
                    <button class="button smallBtn" onclick="return previewOldCustomer();">PREVIEW CUSTOMER</button>
                </td>
            </tr>
        </table>

        <table id="oldCustomerPreview" style="display: none;">
            <colgroup>
                <col style="width: 25%;">
                <col style="width: 25%;">
                <col style="width: 25%;">
                <col style="width: 25%;">
            </colgroup>
            <tr>
                <td style="text-align: center; padding-bottom: 10px;"><button class="button smallBtn" style="width: 200px;" onclick="return showAddShipping();">ADD SHIPPING INFO</button></td>
                <td style="text-align: center; padding-bottom: 10px;"><button class="button smallBtn" style="width: 200px;" onclick="return showChangeBilling();">CHANGE BILLING INFO</button></td>
                <td style="text-align: center; padding-bottom: 10px;"><button class="button smallBtn" style="width: 200px;" onclick="return showChangeTOS();">CHANGE TOS INFO</button></td>
                <td style="text-align: center; padding-bottom: 10px;"><button class="button smallBtn" style="width: 200px;" onclick="return showChangeMarks();">CHANGE MARKS & NUMBER INFO</button></td>
            </tr>
        </table>

        <table id="changeTOS" style="display: none;">
            <colgroup>
                <col style="width: 50%;">
                <col style="width: 50%;">
            </colgroup>
            <tr>
                <th>Terms of Sale</th>
                <th>Terms Location</th>
            </tr>
            <tr>
                <td>
                    <input class="Input_Text" type="text" name="chTOS" id="chTOS" placeholder="Ex: DDP">
                    <br>
                    <div class="errorDiv" id="chTOSE"></div>
                </td>
                <td>
                    <input class="Input_Text" type="text" name="chTOS_Location" id="chTOS_Location" placeholder="Ex: NY">
                    <br>
                    <div class="errorDiv" id="chTOS_LocationE"></div>
                </td>
            </tr>
            <tr>
                <td colspan="2"  style="text-align: center; padding-top:10px;"><button class="button smallBtn" onclick="return changeTOS();">CHANGE TOS</button></td>
            </tr>
        </table>

        <table id="changeBilling" style="display: none;">
            <colgroup>
                <col style="width: 50%;">
                <col style="width: 50%;">
            </colgroup>
            <tr>
                <th>Address Name</th>
                <th>Address Line 1</th>
            </tr>
            <tr>
                <td>
                    <input class="Input_Text" type="text" name="chBl_Name" id="chBl_Name" placeholder="Ex: Brooklyn Facility">
                    <br>
                    <div class="errorDiv" id="chBl_NameE"></div>
                </td>
                <td>
                    <input class="Input_Text" type="text" name="chBl_Add1" id="chBl_Add1" placeholder="Ex: 345 18th Street">
                    <br>
                    <div class="errorDiv" id="chBl_Add1E"></div>
                </td>
            </tr>

            <tr>
                <th>Address Line 2</th>
                <th>Address Line 3</th>
            </tr>
            <tr>
                <td><input class="Input_Text" type="text" name="chBl_Add2" id="chBl_Add2" placeholder="Ex: Recieving"></td>
                <td><input class="Input_Text" type="text" name="chBl_Add3" id="chBl_Add3" placeholder="Ex: Brooklyn, NY 11225"></td>
            </tr>

            <tr>
                <th>Country</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <input class="Input_Text" type="text" name="chBl_Country" id="chBl_Country" placeholder="Ex: USA">
                    <br>
                    <div class="errorDiv" id="chBl_CountryE"></div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2"  style="text-align: center; padding-top:10px;"><button class="button smallBtn" onclick="return changeBilling();">CHANGE BILLING</button></td>
            </tr>
        </table>

        <table id="changeMarks" style="display: none;">
            <tr>
                <td style="text-align: center;">
                    <input class="Input_Text" style="width:800px;" type="text" name="marks[]" placeholder="Line 1">
                    <br>
                    <div class="errorDiv" id="mark1E"></div>
                </td>
            </tr>
        </table>

        <table id="marksButton" style="display: none;">
            <colgroup>
                <col style="width:25%">
                <col style="width:50%">
                <col style="width:25%">
            </colgroup>
            <tr>
                <td style="text-align: center;"><button style="padding: 4px 8px; font-size: 15px; font-weight: bold;" onclick="return chaddMarksNumbers();">+</button></td>
                <td style="text-align: center;"><button class="button smallBtn" onclick="return changeMarks();">CHANGE MARKS</button></td>
                <td style="text-align: center;"><button style="padding: 4px 8px; font-size: 15px; font-weight: bold;" onclick="return chdelMarksNumbers();">&ndash;</button></td>
            </tr>
        </table>

        <table id="addShipping" style="display: none;">
            <colgroup>
                <col style="width: 50%">
                <col style="width: 50%">
            </colgroup>

            <tr>
                <th>Address Name</th>
                <th>Address Line 1</th>
            </tr>
            <tr>
                <td>
                    <input class="Input_Text" type="text" name="adSh_Name" id="adSh_Name" placeholder="Ex: College Point Police Academy">
                    <br>
                    <div class="errorDiv" id="adSh_NameE"></div>
                </td>
                <td>
                    <input class="Input_Text" type="text" name="adSh_Add1" id="adSh_Add1" placeholder="Ex: 127-10 10th Avenue">
                    <br>
                    <div class="errorDiv" id="adSh_Add1E"></div>
                </td>
            </tr>

            <tr>
                <th>Address Line 2</th>
                <th>Address Line 3</th>
            </tr>
            <tr>
                <td><input class="Input_Text" type="text" name="adSh_Add2" id="adSh_Add2" placeholder="Ex: Street level"></td>
                <td><input class="Input_Text" type="text" name="adSh_Add3" id="adSh_Add3" placeholder="Ex: Flushing, NY 11354-2527"></td>
            </tr>

            <tr>
                <th>Country</th>
                <th>Additional Info</th>
            </tr>
            <tr>
                <td>
                    <input class="Input_Text" type="text" name="adSh_Country" id="adSh_Country" placeholder="Ex: USA">
                    <br>
                    <div class="errorDiv" id="adSh_CountryE"></div>
                </td>
                <td><input class="Input_Text" type="text" name="adSh_Additional" id="adSh_Additional"></td>
            </tr>
            <tr>
                <td colspan="2"  style="text-align: center; padding-top:10px;"><button class="button smallBtn" onclick="return addShipping();">ADD SHIPPING</button></td>
            </tr>
        </table>

        <div id="preview_section" style="display: none;">
            <div class="preview_section_heading">
                CUSTOMER PREVIEW
            </div>

            <div class="preview_details">
                <span style="font-weight: bold; color: black;">CUSTOMER NAME: </span>
                ' . $_SESSION["custName"] . '
            </div>

            <div class="preview_details">
                <span style="font-weight: bold; color: black;">TERMS: </span>
                ' . $_SESSION["tos"] . ', ' . $_SESSION["tosLocation"] . '
            </div>

            <div class="preview_details">
                <span style="font-weight: bold; color: black;">SHIPPING ADDRESS: </span>
                ' . $shipping . '
            </div>

            <div class="preview_details">
                <span style="font-weight: bold; color: black;">BILLING ADDRESS: </span>
                ' . $billing . '
            </div>

            <div class="preview_details">
                <span style="font-weight: bold; color: black;">MARKS AND NUMBERS: </span>
                <ol>
                    ' . $marks . '
                </ol>
            </div>
        </div>
    </div>

    <div class="form_section" id="productSection">
        <div class="form_section_heading">
            PRODUCT INFORMATION
            <input type="text" id="productsCount" name="productsCount" style="display: none;" value="' . $productsCount . '">
        </div>

        <div class="form_section_heading" style="left: 80%; top: -35px;">
            <button style="padding: 4px 8px; font-size: 15px; font-weight: bold;" onclick="return addProduct();">+</button>
        </div>

        <div class="form_section_heading" style="left: 87%; top: -55px;">
            <button style="padding: 4px 8px; font-size: 15px; font-weight: bold;" onclick="return delProduct();">&ndash;</button>
        </div>

        <table id="Pgif-Load" style="display: none;">
            <tr>
                <td style="text-align:center; height:80px;"><img src="OTHER/ajax-loader.gif"></td>
            </tr>
        </table>

        <table id="productsList" style="margin: 20px 0;">
            <colgroup>
                <col style="width: 28%">
                <col style="width: 20%">
                <col style="width: 26%">
                <col style="width: 13%">
                <col style="width: 13%">
            </colgroup>
            <thead>
            <tr>
                <th>DSX No</th>
                <th>Quantity</th>
                <th>Price</th>
                <th style="text-align: center;" colspan="2">Price Change</th>
            </tr>
            </thead>

            <tbody id="prodInfo">
            ' . $productList . '
            </tbody>
        </table>

        <table id="productButtons">
            <colgroup>
                <col style="width: 50%;">
                <col style="width: 50%;">
            </colgroup>
            <tr>
                <td style="text-align: center;"><button class="button smallBtn" onclick="return addNewProduct();">ADD NEW PRODUCT</button></td>
                <td style="text-align: center;"><button class="button smallBtn" onclick="return previewProducts();">PREVIEW PRODUCTS</button></td>
            </tr>
        </table>
    </div>

    <div class="form_section">
        <div class="form_section_heading">
            INVOICE INFORMATION
        </div>

        <table>
                <colgroup>
                    <col style="width: 50%">
                    <col style="width: 50%">
                </colgroup>

                <tr>
                    <th>Customer PO Number</th>
                    <th>Invoice Number</th>
                </tr>
                <tr>
                    <td>
                        <input class="Input_Text" type="text" name="custPONO" placeholder="Ex: 123456789-0">
                        <br>
                        <div class="errorDiv" id="custPONOE"></div>
                    </td>
                    <td>
                        <input class="Input_Text" type="text" name="invoiceNo" placeholder="654321">
                        <br>
                        <div class="errorDiv" id="invoiceNoE"></div>
                    </td>
                </tr>

                <tr>
                    <th>Shipper/Exporter</th>
                    <th>Ship Via</th>
                </tr>
                <tr>
                    <td>
                        <select class="Input_Select" name="shipper">
                            <option value="0">CHINA</option>
                            <option value="1">New York, USA</option>
                        </select>
                        <br>
                        <div class="errorDiv" id="shipperE"></div>
                    </td>
                    <td>
                        <select class="Input_Select" name="shipVia">
                            <option value="Ocean">Ocean</option>
                            <option value="Air">Air</option>
                            <option value="Truck">Truck</option>
                            <option value="Courier">Courier</option>
                            <option value="Hand">Hand</option>
                        </select>
                        <br>
                        <div class="errorDiv" id="shipViaE"></div>
                    </td>
                </tr>

                <tr>
                    <th>Date</th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <input class="Input_Text" id="invoiceDate" type="text" name="invoiceDate" placeholder="Format: mm/dd/yyyy">
                        <br>
                        <div class="errorDiv" id="invoiceDateE"></div>
                    </td>
                    <td></td>
                </tr>
            </table>
    </div>

    <div class="btnDiv">
        <input type="submit" class="button" value="GENERATE">
    </div>
</form>

</body>

</html>';

$myfile = fopen("../generator.html", "w") or die("Unable to open file!");
fwrite($myfile, $generatorHTML);
fclose($myfile);

header('Location: ../generator.html');


?>



