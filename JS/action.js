
function addMarksNumbers(){
    var marksTableLen = document.getElementById("marksNumbers").getElementsByTagName("tr").length;
    var rowNum = marksTableLen + 1;
    var newPlaceHolder = "Line " + rowNum;

    var rowHTML = "<td style=\"padding: 0; padding-top: 8px;\">\
                         <input class=\"Input_Text\" style=\"width:700px;\" type=\"text\" name=\"marks[]\" placeholder=\"" + newPlaceHolder + "\">\
                     </td>";

    var newRow = document.createElement("tr");
    newRow.innerHTML = rowHTML;
    document.getElementById("marksNumbers").appendChild(newRow);

    return false;
}

function delMarksNumbers(){
    if(document.getElementById("marksNumbers").getElementsByTagName("tr").length > 1){
        var marksTableAnchor = document.getElementById("marksNumbers");
        marksTableAnchor.removeChild(marksTableAnchor.childNodes[document.getElementById("marksNumbers").getElementsByTagName("tr").length]);
    }

    return false;
}

function chaddMarksNumbers(){
    var marksTableLen = document.getElementById("changeMarks").getElementsByTagName("tr").length;
    var rowNum = marksTableLen + 1;
    var newPlaceHolder = "Line " + rowNum;

    var rowHTML = "<td style=\"text-align: center;\">\
                         <input class=\"Input_Text\" style=\"width:800px;\" type=\"text\" name=\"marks[]\" placeholder=\"" + newPlaceHolder + "\">\
                     </td>";

    var newRow = document.createElement("tr");
    newRow.innerHTML = rowHTML;
    document.getElementById("changeMarks").appendChild(newRow);

    return false;
}

function chdelMarksNumbers(){
    if(document.getElementById("changeMarks").getElementsByTagName("tr").length > 1){
        var marksTableAnchor = document.getElementById("changeMarks");
        marksTableAnchor.removeChild(marksTableAnchor.childNodes[document.getElementById("changeMarks").getElementsByTagName("tr").length]);
    }

    return false;
}

function addProduct(){
    var dirArr = window.location.pathname.split('/');
    var prodAddress = "";

    if (dirArr[dirArr.length - 2] == "PHP"){
        prodAddress = "../JSON/productDSXs.json";
    }
    else {
        prodAddress = "JSON/productDSXs.json"
    }

    var productDSXs = new Array();
    $.getJSON(prodAddress, function (data) {
        var dataLen = data.length;

        for (var i = 0; i < dataLen; i++){
            productDSXs[i] = data[i];
        }
    });

    var productsCount = parseInt($('#productsCount').val()) + 1;
    $('#productsCount').val(productsCount);

    var rowHTML = "<td><input class=\"Input_Text typeaheadP\" type=\"text\" name=\"DSX" + productsCount + "\" style=\"width:150px;\" placeholder=\"Ex: 12345\"><br><div class=\"errorDiv\" id=\"DSX" + productsCount + "E\"></td>\
                             <td><input class=\"Input_Text\" style=\"width: 100px;\" type=\"text\" name=\"Quantity" + productsCount + "\" placeholder=\"Ex: 10\"></td>\
                             <td>$&nbsp;&nbsp;<input class=\"Input_Text priceTag\" style=\"width: 120px;\" type=\"text\" name=\"Price" + productsCount + "\" placeholder=\"Ex: 10.5\" disabled>&nbsp;&nbsp;&nbsp;<a href=\"\" onclick=\"return updatePrice(" + productsCount + ");\" style=\"font-size: 12px; font-weight: normal; color: #858585;\">Update Price</a></td>\
                             <td style=\"display: none;\"><label for='def" + productsCount + "'><input type=\"radio\" id='def" + productsCount + "' name=\"priceChange" + productsCount + "\" value=\"2\" ></label></td>\
                             <td style=\"text-align: center;\"><label for='temp" + productsCount + "'>&nbsp;&nbsp;Temporary<input type=\"radio\" id='temp" + productsCount + "' name=\"priceChange" + productsCount + "\" value=\"0\" onclick=\"return enablePrice(" + productsCount + ", 't')\" style=\"size: 20px;\"></label></td>\
                             <td style=\"text-align: center;\"><label for='perm" + productsCount + "'>&nbsp;&nbsp;Permanent<input type=\"radio\" id='perm" + productsCount + "' name=\"priceChange" + productsCount + "\" value=\"1\" onclick=\"return enablePrice(" + productsCount + ", 'p')\" style=\"size: 20px;\"></label></td>";

    var newRow = document.createElement("tr");
    newRow.innerHTML = rowHTML;
    document.getElementById("prodInfo").appendChild(newRow);

    $(newRow).on("keyup", "input[name=DSX" + productsCount + "]", function(event){
        // alert(this.name);
        $(this).typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            },
            {
                name: 'productDSXs',
                source: substringMatcher(productDSXs),
                templates:{notFound:'No Record Found'}
            });
        $('input[name=DSX' + productsCount + ']').focus();
    });

    return false;
}

function delProduct(){
    if(document.getElementById("prodInfo").getElementsByTagName("tr").length > 1){
        var productsCount = parseInt($('#productsCount').val()) - 1;
        $('#productsCount').val(productsCount);

        var prodRowAnchor = document.getElementById("prodInfo");
        prodRowAnchor.removeChild(prodRowAnchor.childNodes[document.getElementById("prodInfo").getElementsByTagName("tr").length + 1]);
    }

    return false;
}

function showOldCustomer(){
    $('#customerMain').fadeOut(1000);
    setTimeout(function() {
        $('#oldCustomer').fadeIn(1000);
    }, '1000');

    return false;
}

var substringMatcher = function(strs) {
    console.log(strs.length);
    return function findMatches(q, cb) {
        var matches, substringRegex;

        // an array that will be populated with substring matches
        matches = [];

        // regex used to determine if a string contains the substring `q`
        substrRegex = new RegExp(q, 'i');

        // iterate through the pool of strings and for any string that
        // contains the substring `q`, add it to the `matches` array
        $.each(strs, function(i, str) {
            if (substrRegex.test(str)) {
                matches.push(str);
            }
        });

        cb(matches);
    };
};


$(document).ready(function () {
    var dirArr = window.location.pathname.split('/');
    var custAddress = "";

    if (dirArr[dirArr.length - 2] == "PHP"){
        custAddress = "../JSON/customerNames.json";
    }
    else {
        custAddress = "JSON/customerNames.json"
    }

    var customerNames = new Array();
    $.getJSON(custAddress, function (data) {
        var dataLen = data.length;

        for (var i = 0; i < dataLen; i++){
            customerNames[i] = data[i];
        }
    });

    $('.typeaheadC').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'customerNames',
            source: substringMatcher(customerNames),
            templates:{notFound:'No Record Found'}
        });


    var prodAddress = "";

    if (dirArr[dirArr.length - 2] == "PHP"){
        prodAddress = "../JSON/productDSXs.json";
    }
    else {
        prodAddress = "JSON/productDSXs.json"
    }

    var productDSXs = new Array();
    $.getJSON(prodAddress, function (data) {
        var dataLen = data.length;

        for (var i = 0; i < dataLen; i++){
            productDSXs[i] = data[i];
        }
    });

    $('.typeaheadP').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'productDSXs',
            source: substringMatcher(productDSXs),
            templates:{notFound:'No Record Found'}
        });

    $( "#invoiceDate" ).datepicker({
        changeMonth: true,
        changeYear: true,
        currentText: "Now"
    });
    $('#invoiceDate').datepicker().datepicker('setDate', new Date());

});

function populateShipping(){
    $.ajax({url:'PHP/populateShipping.php',
            method:'POST',
            data:{
                custName: $('#Cust_Name').val()
            },
            beforeSend:function(){
                $('#gif-Load').show();
                $('#oldCustomer').hide();
            },
            success:function (data) {
                var dataObj = $.parseJSON(data);
                var dataLen = dataObj.length;
                if (dataLen == 0){
                    $('#Cust_NameE').html('Invalid Customer Name');
                    $('#Cust_NameE').show();
                }
                else{
                    for (var i = 0; i < dataLen; i++){
                        $('#Cust_Shipping').append(dataObj[i]);
                    }
                    $('#Cust_Shipping').prop('disabled', false);
                    $('#Cust_NameE').hide();
                    $('#previewOldCustomer').show();
                }


                $('#gif-Load').hide();
                $('#oldCustomer').show();

            }});

    return false;
}

function previewOldCustomer(){
    $.ajax({
        url:'PHP/previewOldCustomer.php',
        method:'POST',
        data:{
            custName:$('#Cust_Name').val(),
            custShipping:$('#Cust_Shipping').val()
        },
        beforeSend:function(){
            $('#gif-Load').show();
            $('#oldCustomer').hide();
        },
        success:function(data){
            window.location.href = 'PHP/generator.php';
        }
    });

    return false;
}

function changeTOS(){
    $.ajax({
        url:'PHP/changeTOS.php',
        method:'POST',
        data:{
            TOS:$('#chTOS').val(),
            TOS_Location:$('#chTOS_Location').val()
        },
        beforeSend:function(){
            $('#gif-Load').show();
            $('#changeTOS').hide();
            $('#oldCustomerPreview').hide();
            $('#preview_section').hide();
        },
        success:function(data){
            window.location.href = 'PHP/generator.php';
        }
    });

    return false;
}

function showChangeTOS() {
    $('#oldCustomerPreview').fadeOut(1000);
    setTimeout(function() {
        $('#changeTOS').fadeIn(1000);
    }, '1000');

    return false;
}

function changeBilling() {
    $.ajax({
        url:'PHP/changeBilling.php',
        method:'POST',
        data:{
            Bl_Name:$('#chBl_Name').val(),
            Bl_Add1:$('#chBl_Add1').val(),
            Bl_Add2:$('#chBl_Add2').val(),
            Bl_Add3:$('#chBl_Add3').val(),
            Bl_Country:$('#chBl_Country').val()
        },
        beforeSend:function(){
            $('#gif-Load').show();
            $('#changeBilling').hide();
            $('#oldCustomerPreview').hide();
            $('#preview_section').hide();
        },
        success:function(data){
            window.location.href = 'PHP/generator.php';
        }
    });

    return false;
}

function showChangeBilling() {
    $('#oldCustomerPreview').fadeOut(1000);
    setTimeout(function() {
        $('#changeBilling').fadeIn(1000);
    }, '1000');

    return false;
}

function changeMarks() {
    var marksArray = new Array();
    marksArray = $('input[name="marks[]"]').map(function(){
        return $(this).val();
    }).get();
    $.ajax({
        url:'PHP/changeMarks.php',
        method:'POST',
        data:{
            marks:marksArray
        },
        beforeSend:function(){
            $('#gif-Load').show();
            $('#changeMarks').hide();
            $('#oldCustomerPreview').hide();
            $('#preview_section').hide();
            $('#marksButton').hide();
        },
        success:function(data){
            window.location.href = 'PHP/generator.php';
        }
    });

    return false;
}

function showChangeMarks() {
    $('#oldCustomerPreview').fadeOut(1000);
    setTimeout(function() {
        $('#changeMarks, #marksButton').fadeIn(1000);
    }, '1000');

    return false;
}

function addShipping() {
    $.ajax({
        url:'PHP/addShipping.php',
        method:'POST',
        data:{
            Sh_Name:$('#adSh_Name').val(),
            Sh_Add1:$('#adSh_Add1').val(),
            Sh_Add2:$('#adSh_Add2').val(),
            Sh_Add3:$('#adSh_Add3').val(),
            Sh_Country:$('#adSh_Country').val(),
            Sh_Additional:$('#adSh_Additional').val()
        },
        beforeSend:function(){
            $('#gif-Load').show();
            $('#addShipping').hide();
            $('#oldCustomerPreview').hide();
            $('#preview_section').hide();
        },
        success:function(data){
            window.location.href = 'PHP/generator.php';
        }
    });

    return false;
}

function showAddShipping() {
    $('#oldCustomerPreview').fadeOut(1000);
    setTimeout(function() {
        $('#addShipping').fadeIn(1000);
    }, '1000');

    return false;
}

function enablePrice(num, type) {
    var radioID = "";
    if(type == 't'){
        radioID = "#temp" + num;
    }
    else{
        radioID = "#perm" + num;
    }

    var priceName = "Price" + num;
    $('input[name="' + priceName + '"]').prop("disabled", false);
    document.getElementById(radioID).checked = true;

    return false;
}

function addNewProduct() {
    var productsCount = $('#productsCount').val();

    var dsxArray            = [];
    var quantityArray       = [];
    var priceArray         = [];
    var priceChangeArray    = [];

    var dirArr      = window.location.pathname.split('/');
    var prodAddress = "";

    if (dirArr[dirArr.length - 2] == "PHP"){
        prodAddress = "../JSON/productDSXs.json";
    }
    else {
        prodAddress = "JSON/productDSXs.json"
    }

    // GET PRODUCTS DSX JSON
    var productDSXs = new Array();
    $.getJSON(prodAddress, function (data) {
        var dataLen = data.length;

        for (var i = 0; i < dataLen; i++){
            productDSXs[i] = data[i];
        }
    });

    // CONVERT PRODUCTS DSX IN ARRAY FROM STRING TO NUMBER
    productDSXs.map(Number);

    // GET PRODUCTS INFROMATION FROM GENERATOR.PHP
    var prodData = [];

    for (var j = 1; j <= productsCount; j++){
        prodData[j - 1] = [document.getElementsByName('DSX' + j)[0].value, document.getElementsByName('Quantity' + j)[0].value, document.getElementsByName('Price' + j)[0].value, document.getElementsByName('priceChange' + j)[0].value];
    }

    // REMOVE DUPLICATE PRODUCTS (SAME DSX) FROM PRODUCTS DATA
    var uniqueProdData = [], keys = []; // Create an array for storing the key values
    for (var i in prodData) {
        if (keys.indexOf(prodData[i][0]) === -1) {
            uniqueProdData.push(prodData[i]); // Push the value onto the unique array
            keys.push(prodData[i][0]); // Push the key onto the 'key' array
        }
    }

    // REMOVE INVALID PRODUCTS (INVALID DSX) FROM PRODUCTS DATA
    var invalidKeys = [];

    for(var k = 0, l = uniqueProdData.length; k < l; k++){
        if(!productDSXs.includes(uniqueProdData[k][0])){
            invalidKeys.push(uniqueProdData.indexOf(uniqueProdData[k][0]));
        }
    }

    invalidKeys.sort(function (a, b) {
        return b - a;
    });

    for(var m = 0, n = invalidKeys.length; m < n; m++){
        uniqueProdData.splice(invalidKeys[m], 1);
    }

    // SEPERATE PRODUCTS DATA INTO DSX, QUANTITY AND PRICE CHANGE ARRAYS
    for(var i = 0, j = uniqueProdData.length; i < j; i++){
        dsxArray.push(uniqueProdData[i][0]);
        quantityArray.push(uniqueProdData[i][1]);
        priceArray.push(uniqueProdData[i][2]);
        priceChangeArray.push(uniqueProdData[i][3]);
    }

    $.ajax({
        url:'PHP/productsMemory.php',
        method:'POST',
        data:{
            dsxs:dsxArray,
            quantities:quantityArray,
            prices:priceArray,
            priceChanges:priceChangeArray
        },
        beforeSend:function(){
            $('#Pgif-Load').show();
            $('#productsList').hide();
            $('#productButtons').hide();
        },
        success:function () {
            window.location.href = 'Register-Product.html';
        }
    });

    return false;
}

function previewProducts() {
    var productsCount = $('#productsCount').val();

    var dsxArray = [];
    var quantityArray = [];
    var priceArray = [];
    var priceChangeArray = [];

    var dirArr = window.location.pathname.split('/');
    var prodAddress = "";

    if (dirArr[dirArr.length - 2] == "PHP"){
        prodAddress = "../JSON/productDSXs.json";
    }
    else {
        prodAddress = "JSON/productDSXs.json"
    }

    // GET PRODUCTS DSX JSON
    var productDSXs = new Array();
    $.getJSON(prodAddress, function (data) {
        var dataLen = data.length;

        for (var i = 0; i < dataLen; i++){
            productDSXs[i] = Number(data[i]);
        }
    });

    // GET PRODUCTS INFROMATION FROM GENERATOR.PHP
    var prodData = [];

    for (var j = 1; j <= productsCount; j++){
        prodData[j - 1] = [document.getElementsByName('DSX' + j)[0].value, document.getElementsByName('Quantity' + j)[0].value, document.getElementsByName('Price' + j)[0].value, $('input[name=priceChange' + j + ']:checked').val()];
    }

    // REMOVE DUPLICATE PRODUCTS (SAME DSX) FROM PRODUCTS DATA
    var uniqueProdData = [], keys = []; // Create an array for storing the key values
    for (var i in prodData) {
        if (keys.indexOf(prodData[i][0]) === -1) {
            uniqueProdData.push(prodData[i]); // Push the value onto the unique array
            keys.push(prodData[i][0]); // Push the key onto the 'key' array
        }
    }

    // REMOVE INVALID PRODUCTS (INVALID DSX) FROM PRODUCTS DATA
    var invalidKeys = [];

    for(var k = 0, l = uniqueProdData.length; k < l; k++){
        var tempVal = productDSXs.includes(Number(uniqueProdData[k][0]));
        if(tempVal == -1){
            invalidKeys.push(k);
        }
    }

    invalidKeys.sort(function (a, b) {
        return b - a;
    });

    for(var m = 0, n = invalidKeys.length; m < n; m++){
        uniqueProdData.splice(invalidKeys[m], 1);
    }

    // SEPERATE PRODUCTS DATA INTO DSX, QUANTITY AND PRICE CHANGE ARRAYS
    for(var i = 0, j = uniqueProdData.length; i < j; i++){
        dsxArray.push(uniqueProdData[i][0]);
        quantityArray.push(uniqueProdData[i][1]);
        priceArray.push(uniqueProdData[i][2]);
        priceChangeArray.push(uniqueProdData[i][3]);
    }

    $.ajax({
        url:'PHP/previewProducts.php',
        method:'POST',
        data:{
            dsxs:dsxArray,
            quantities:quantityArray,
            prices:priceArray,
            priceChanges:priceChangeArray
        },
        beforeSend:function(){
            $('#Pgif-Load').show();
            $('#productsList').hide();
            $('#productButtons').hide();
        },
        success:function () {
            window.location.href = 'previewProducts.html';
        }
    });

    return false;
}

function updatePrice(num) {
    var dsxName = 'DSX' + num;
    $.ajax({url:'PHP/updatePrice.php',
        method:'POST',
        data:{
            dsx: $('input[name="' + dsxName + '"]').val()
        },
        beforeSend:function(){
            $('#Pgif-Load').show();
            $('#productsList').hide();
            $('#productButtons').hide();
        },
        success:function (data) {
            var productPrice = $.parseJSON(data);

            if (productPrice == ''){
                $('input[name="Price' + num + '"]').val('');
                $('#DSX' + num + 'E').html('Invalid DSX Number');
                $('#DSX' + num + 'E').show();
                $('#Pgif-Load').hide();
                $('#productsList').show();
                $('#productButtons').show();
            }
            else{
                $('input[name="Price' + num + '"]').val(parseFloat(data.replace('"', '')));
                $('#DSX' + num + 'E').hide();
                $('#Pgif-Load').hide();
                $('#productsList').show();
                $('#productButtons').show();
            }
        }});

    return false;
}
