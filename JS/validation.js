
function validateCustomer(){
    var status  =   0;
    var Req     =   "This field can't be empty";

    var custName        =   document.getElementsByName("Cust_Name")[0].value;
    var TOS             =   document.getElementsByName("TOS")[0].value;
    var termsLocation   =   document.getElementsByName("TOS_Location")[0].value;
    var shName          =   document.getElementsByName("Sh_Name")[0].value;
    var shAdd1          =   document.getElementsByName("Sh_Add1")[0].value;
    var shCountry       =   document.getElementsByName("Sh_Country")[0].value;
    var blName          =   document.getElementsByName("Bl_Name")[0].value;
    var blAdd1          =   document.getElementsByName("Bl_Add1")[0].value;
    var blCountry       =   document.getElementsByName("Bl_Country")[0].value;
    var mark1           =   document.getElementsByName("mark1")[0].value;

    if(custName == ""){
        document.getElementById("Cust_NameE").innerHTML = Req;
        document.getElementById("Cust_NameE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Cust_NameE").style.display = "none";
    }

    if(TOS == ""){
        document.getElementById("TOSE").innerHTML = Req;
        document.getElementById("TOSE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("TOSE").style.display = "none";
    }

    if(TOS != TOS.toUpperCase()) {
        document.getElementById("TOSE").innerHTML = "Field should be uppercase";
        document.getElementById("TOSE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("TOSE").style.display = "none";
    }

    if(termsLocation == ""){
        document.getElementById("TOS_LocationE").innerHTML = Req;
        document.getElementById("TOS_LocationE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("TOS_LocationE").style.display = "none";
    }

    if(shName == ""){
        document.getElementById("Sh_NameE").innerHTML = Req;
        document.getElementById("Sh_NameE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Sh_NameE").style.display = "none";
    }

    if(shAdd1 == ""){
        document.getElementById("Sh_Add1E").innerHTML = Req;
        document.getElementById("Sh_Add1E").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Sh_Add1E").style.display = "none";
    }

    if(shCountry == ""){
        document.getElementById("Sh_CountryE").innerHTML = Req;
        document.getElementById("Sh_CountryE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Sh_CountryE").style.display = "none";
    }

    if(blName == ""){
        document.getElementById("Bl_NameE").innerHTML = Req;
        document.getElementById("Bl_NameE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Bl_NameE").style.display = "none";
    }

    if(blAdd1 == ""){
        document.getElementById("Bl_Add1E").innerHTML = Req;
        document.getElementById("Bl_Add1E").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Bl_Add1E").style.display = "none";
    }

    if(blCountry == ""){
        document.getElementById("Bl_CountryE").innerHTML = Req;
        document.getElementById("Bl_CountryE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Bl_CountryE").style.display = "none";
    }

    if(mark1 == ""){
        document.getElementById("mark1E").innerHTML = Req;
        document.getElementById("mark1E").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("mark1E").style.display = "none";
    }

    if(status == 1){
        return false;
    }
    else{
        return true;
    }
}

function validateProduct(){
    var status  =   0;
    var Req     =   "This field can't be empty";

    var DSX1            =   document.getElementsByName("DSX1")[0].value;
    var Cust_Item_No    =   document.getElementsByName("Cust_Item_No")[0].value;
    var HTS1            =   document.getElementsByName("HTS1")[0].value;
    var HTS2            =   document.getElementsByName("HTS2")[0].value;
    var HTS3            =   document.getElementsByName("HTS3")[0].value;
    var Prod_Unit       =   document.getElementsByName("Prod_Unit")[0].value;
    var Prod_Price      =   document.getElementsByName("Prod_Price")[0].value;
    var Manf_Name       =   document.getElementsByName("Manf_Name")[0].value;
    var Manf_Add1       =   document.getElementsByName("Manf_Add1")[0].value;
    var Prod_MID        =   document.getElementsByName("Prod_MID")[0].value;
    var Prod_GW         =   document.getElementsByName("Prod_GW")[0].value;
    var Prod_NW         =   document.getElementsByName("Prod_NW")[0].value;
    var Prod_Qt         =   document.getElementsByName("Prod_Qt")[0].value;
    var Prod_Dim1       =   document.getElementsByName("Prod_Dim1")[0].value;
    var Prod_Dim2       =   document.getElementsByName("Prod_Dim2")[0].value;
    var Prod_Dim3       =   document.getElementsByName("Prod_Dim3")[0].value;

    if(DSX1 == ""){
        document.getElementById("DSX1E").innerHTML = Req;
        document.getElementById("DSX1E").style.display = "inline";
        status = 1;
    }
    else if(!/^\+?(0|[1-9]\d*)$/.test(DSX1)){
        document.getElementById("DSX1E").innerHTML = "DSX should only have numeric value";
        document.getElementById("DSX1E").style.display = "inline";
        status = 1;
    }
    else if(DSX1.length != 5){
        document.getElementById("DSX1E").innerHTML = "DSX should be of size 5";
        document.getElementById("DSX1E").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("DSX1E").style.display = "none";
    }

    if(Cust_Item_No == ""){
        document.getElementById("Cust_Item_NoE").innerHTML = Req;
        document.getElementById("Cust_Item_NoE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Cust_Item_NoE").style.display = "none";
    }

    if(HTS1 == "" || HTS2 == "" || HTS3 == ""){
        document.getElementById("HTS1E").innerHTML = "Any HTS field can't be empty";
        document.getElementById("HTS1E").style.display = "inline";
        status = 1;
    }
    else if(!/^\+?(0|[1-9]\d*)$/.test(HTS1) || !/^\+?(0|[1-9]\d*)$/.test(HTS2) || !/^\+?(0|[1-9]\d*)$/.test(HTS3)){
        document.getElementById("HTS1E").innerHTML = "All HTS fields should have numeric value";
        document.getElementById("HTS1E").style.display = "inline";
        status = 1;
    }
    else if(HTS1.length != 4 || HTS2.length != 2 || HTS3.length != 4){
        document.getElementById("HTS1E").innerHTML = "HTS format should be: 4 Numerics . 2 Numerics . 4 Numerics";
        document.getElementById("HTS1E").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("HTS1E").style.display = "none";
    }

    if(Prod_Unit != "Per Set" && Prod_Unit != "Per Case"){
        document.getElementById("Prod_UnitE").innerHTML = "One of options should be selected";
        document.getElementById("Prod_UnitE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Prod_UnitE").style.display = "none";
    }

    if(Prod_Price == ""){
        document.getElementById("Prod_PriceE").innerHTML = Req;
        document.getElementById("Prod_PriceE").style.display = "inline";
        status = 1;
    }
    else if(isNaN(Prod_Price) || Number(Prod_Price) <= 0){
        document.getElementById("Prod_PriceE").innerHTML = "This field should only have positive numeric value";
        document.getElementById("Prod_PriceE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Prod_PriceE").style.display = "none";
    }

    if(Manf_Name == ""){
        document.getElementById("Manf_NameE").innerHTML = Req;
        document.getElementById("Manf_NameE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Manf_NameE").style.display = "none";
    }

    if(Manf_Add1 == ""){
        document.getElementById("Manf_Add1E").innerHTML = Req;
        document.getElementById("Manf_Add1E").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Manf_Add1E").style.display = "none";
    }

    /*
    if(Prod_MID == ""){
        document.getElementById("Prod_MIDE").innerHTML = Req;
        document.getElementById("Prod_MIDE").style.display = "inline";
        status = 1;
    }
    else if(Prod_MID == '^[A-Z0-9]+$'){
        document.getElementById("Prod_MIDE").innerHTML = "Field should only have capital alphanumeric value";
        document.getElementById("Prod_MIDE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Prod_MIDE").style.display = "none";
    }
    */

    if(Prod_GW == ""){
        document.getElementById("Prod_GWE").innerHTML = Req;
        document.getElementById("Prod_GWE").style.display = "inline";
        status = 1;
    }
    else if(isNaN(Prod_GW) || Number(Prod_GW) <= 0){
        document.getElementById("Prod_GWE").innerHTML = "Field should only have positive numeric value";
        document.getElementById("Prod_GWE").style.display = "inline";
        status = 1
    }
    else{
        document.getElementById("Prod_GWE").style.display = "none";
    }

    if(Prod_NW == ""){
        document.getElementById("Prod_NWE").innerHTML = Req;
        document.getElementById("Prod_NWE").style.display = "inline";
        status = 1;
    }
    else if(isNaN(Prod_NW) || Number(Prod_NW) <= 0){
        document.getElementById("Prod_NWE").innerHTML = "Field should only have positive numeric value";
        document.getElementById("Prod_NWE").style.display = "inline";
        status = 1
    }
    else{
        document.getElementById("Prod_NWE").style.display = "none";
    }

    if(Prod_Qt == ""){
        document.getElementById("Prod_QtE").innerHTML = Req;
        document.getElementById("Prod_QtE").style.display = "inline";
        status = 1;
    }
    else if(!/^\+?(0|[1-9]\d*)$/.test(Prod_Qt)){
        document.getElementById("Prod_QtE").innerHTML = "Field should only have positive numeric value";
        document.getElementById("Prod_QtE").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Prod_QtE").style.display = "none";
    }

    if(Prod_Dim1 == "" || Prod_Dim2 == "" || Prod_Dim3 == ""){
        document.getElementById("Prod_Dim1E").innerHTML = Req;
        document.getElementById("Prod_Dim1E").style.display = "inline";
        status = 1;
    }
    else if((isNaN(Prod_Dim1) || Number(Prod_Dim1) <= 0) || (isNaN(Prod_Dim2) || Number(Prod_Dim2) <= 0) || ((isNaN(Prod_Dim3) || Number(Prod_Dim3) <= 0))){
        document.getElementById("Prod_Dim1E").innerHTML = "All dimension fields should have only positive numeric value";
        document.getElementById("Prod_Dim1E").style.display = "inline";
        status = 1;
    }
    else{
        document.getElementById("Prod_Dim1E").style.display = "none";
    }

    if(status == 1){
        return false;
    }
    else{
        return true;
    }
}