<?php
/**
 * Created by PhpStorm.
 * User: Miraj
 * Date: 11/9/2018
 * Time: 3:25 PM
 */

session_start();

$noOfProducts                   = count($_POST['dsxs']);
$_SESSION['productsMemory']     = [];

for ($i = 0; $i < $noOfProducts; $i++){
    $productMemory = array();
    $productMemory['dsx']          = $_POST['dsxs'][$i];
    $productMemory['quantity']     = $_POST['quantities'][$i];
    $productMemory['price']        = $_POST['prices'][$i];
    $productMemory['priceChange']  = $_POST['priceChanges'][$i];

    $_SESSION['productsMemory'][] = $productMemory;
}

$registerProductHTML = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>REGISTER PRODUCT</title>

    <link rel="stylesheet" href="CSS/style.css">

    <script src="JS/jquery.min.js"></script>
    <script src="JS/jQuery-ui.js"></script>
    <script src="JS/typeahead.js"></script>

    <script src="JS/validation.js"></script>
    <script src="JS/action.js"></script>
</head>
<body>
    <form method="post" action="PHP/products.php">
        <div class="form_section">
            <div class="form_section_heading">
                CUSTOMER\'S PRODUCT INFO
            </div>

            <table>
                <colgroup>
                    <col style="width: 50%">
                    <col style="width: 50%">
                </colgroup>

                <tr>
                    <th>Customer Name</th>
                    <th>Product DSX No</th>
                </tr>
                <tr>
                    <td>

                        <div id="custName">' . $_SESSION['custName'] . '</div>
                        <!--<input class="Input_Text typeahead" type="text" name="Cust_Name" placeholder="Ex: NYPD Equipment Section" autofocus>-->
                        <!--<br>-->
                        <!--<div class="errorDiv" id="Cust_NameE"></div>-->
                    </td>
                    <td>
                        DSX&nbsp;&nbsp;&nbsp;<input class="Input_Text" type="text" class="DSX1" name="DSX1" placeholder="Ex: 12345" style="width: 70px;">&nbsp; &nbsp;<input class="Input_Text" type="text" class="DSX2" name="DSX2" style="width: 177px;">
                        <br>
                        <div class="errorDiv" id="DSX1E"></div>
                    </td>
                </tr>

                <tr>
                    <th>Customer\'s Item No</th>
                    <th>Customer\'s PO Desc.</th>
                </tr>
                <tr>
                    <td>
                        <input class="Input_Text" type="text" name="Cust_Item_No" placeholder="Ex: SKU 321/123-4">
                        <br>
                        <div class="errorDiv" id="Cust_Item_NoE"></div>
                    </td>
                    <td><input class="Input_Text" type="text" name="Cust_PO_Desc" placeholder="Ex: BAG, RECRUIT"></td>
                </tr>
            </table>
        </div>

        <div class="form_section">
            <div class="form_section_heading">
                PRODUCT INFO
            </div>

            <table>
                <colgroup>
                    <col style="width: 50%">
                    <col style="width: 50%">
                </colgroup>

                <tr>
                    <th>Material</th>
                    <th>Description 1</th>
                </tr>
                <tr>
                    <td><input class="Input_Text" type="text" name="Prod_Material1" placeholder="Ex: 100% Polyster"></td>
                    <td><input class="Input_Text" type="text" name="Prod_Material2" placeholder=""></td>
                </tr>

                <tr>
                    <th>Descritpion 2</th>
                    <th>Description 3</th>
                </tr>
                <tr>
                    <td><input class="Input_Text" type="text" name="Prod_Material3" placeholder=""></td>
                    <td><input class="Input_Text" type="text" name="Prod_Material4" placeholder=""></td>
                </tr>

                <tr>
                    <th>Description 4</th>
                    <th>HTSUS No</th>
                </tr>
                <tr>
                    <td><input class="Input_Text" type="text" name="Prod_Material5" placeholder=""></td>
                    <td>
                        HTS&nbsp;&nbsp;&nbsp;<input class="Input_Text" id="HTS1" type="text" name="HTS1" placeholder="Ex: 1234">&nbsp;&nbsp;.&nbsp;&nbsp;<input class="Input_Text" id="HTS2" type="text" name="HTS2" placeholder="Ex: 00">&nbsp;&nbsp;.&nbsp;&nbsp;<input class="Input_Text" id="HTS3" type="text" name="HTS3" placeholder="Ex: 4321">
                        <br>
                        <div class="errorDiv" id="HTS1E"></div>
                    </td>
                </tr>

                <tr>
                    <th>Unit of Sale</th>
                    <th>Price per unit</th>
                </tr>
                <tr>
                    <td>
                        <select class="Input_Select" name="Prod_Unit">
                            <option value="Per Piece">Per Piece</option>
                            <option value="Per Set">Per Set</option>
                            <option value="Per Case">Per Case</option>
                        </select>
                        <br>
                        <div class="errorDiv" id="Prod_UnitE"></div>
                    </td>
                    <td>
                        $&nbsp;&nbsp;&nbsp;<input class="Input_Text" type="text" name="Prod_Price" placeholder="Ex: 12.00">
                        <br>
                        <div class="errorDiv" id="Prod_PriceE"></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="form_section">
            <div class="form_section_heading">
                MANUFACTURER\'S INFO
            </div>

            <table>
                <colgroup>
                    <col style="width: 50%">
                    <col style="width: 50%">
                </colgroup>

                <tr>
                    <th>Manufacturer Name</th>
                    <th>Address Line 1</th>
                </tr>
                <tr>
                    <td>
                        <input class="Input_Text" type="text" name="Manf_Name" placeholder="Ex: Xiamen Peng Cande Industry">
                        <br>
                        <div class="errorDiv" id="Manf_NameE"></div>
                    </td>
                    <td>
                        <input class="Input_Text" type="text" name="Manf_Add1" placeholder="Ex: 2/F, No 2 Meixi Street">
                        <br>
                        <div class="errorDiv" id="Manf_Add1E"></div>
                    </td>
                </tr>

                <tr>
                    <th>Address Line 2</th>
                    <th>Address Line 3</th>
                </tr>
                <tr>
                    <td><input class="Input_Text" type="text" name="Manf_Add2" placeholder="Ex: Huli Industrial Garden"></td>
                    <td><input class="Input_Text" type="text" name="Manf_Add3" placeholder="Ex: Xiamen 361100 CHINA"></td>
                </tr>
                <tr>
                    <th>Country</th>
                    <th>MID Code</th>
                </tr>
                <tr>
                    <td><input class="Input_Text" type="text" name="Manf_Country" placeholder="Ex: China"></td>
                    <td>
                        <input class="Input_Text" type="text" name="Prod_MID" placeholder="Ex: CNPENCAN28XIA">
                        <br>
                        <div class="errorDiv" id="Prod_MIDE"></div>
                    </td>
                </tr>
                <tr>
                    <th>Description for Docs</th>
                    <th></th>
                </tr>
                <tr>
                    <td><input class="Input_Text" type="text" name="Prod_Custom_Docs" placeholder="Ex: Weekender"></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <div class="form_section">
            <div class="form_section_heading">
                PRODUCT PACKING LIST INFO
            </div>

            <table>
                <colgroup>
                    <col style="width: 50%">
                    <col style="width: 50%">
                </colgroup>

                <tr>
                    <th>Gross Weight</th>
                    <th>Net Weight</th>
                </tr>
                <tr>
                    <td>
                        <input class="Input_Text" type="text" name="Prod_NW" placeholder="Ex: 18.00">&nbsp;&nbsp;&nbsp;KG
                        <br>
                        <div class="errorDiv" id="Prod_NWE"></div>
                    </td>
                    <td>
                        <input class="Input_Text" type="text" name="Prod_GW" placeholder="Ex: 15.00">&nbsp;&nbsp;&nbsp;KG
                        <br>
                        <div class="errorDiv" id="Prod_GWE"></div>
                    </td>
                </tr>

                <tr>
                    <th>Quantity per Case</th>
                    <th>Dimensions</th>
                </tr>
                <tr>
                    <td>
                        <input class="Input_Text" type="text" name="Prod_Qt" placeholder="Ex: 20">
                        <br>
                        <div class="errorDiv" id="Prod_QtE"></div>
                    </td>
                    <td>
                        <input class="Input_Text DIM" type="text" name="Prod_Dim_L" placeholder="Ex: 10.00(L)">&nbsp;&nbsp;&times;&nbsp;&nbsp;<input class="Input_Text DIM" type="text" name="Prod_Dim_W" placeholder="Ex: 20.00(W)">&nbsp;&nbsp;&times;&nbsp;&nbsp;<input class="Input_Text DIM" type="text" name="Prod_Dim_H" placeholder="Ex: 30.00(H)">&nbsp;&nbsp;&nbsp;cm<sup>3</sup>
                        <br>
                        <div class="errorDiv" id="Prod_Dim1E"></div>
                    </td>
                </tr>
            </table>
        </div>

        <div class="btnDiv">
            <input type="submit" class="button" value="REGISTER PRODUCT" onclick="return validateProduct();" />
        </div>

    </form>
</body>
</html>';

$myfile = fopen("../Register-Product.html", "w") or die("Unable to open file!");
fwrite($myfile, $registerProductHTML);
fclose($myfile);

//header('Location: ../Register-Product.html');

?>