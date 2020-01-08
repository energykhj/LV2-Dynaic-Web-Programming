/* ==========================================================================
    Heuijin Ko(8187452), Jeonghwan Ju(8227969)
    Javascript for Assginment4   
    My Shop

    Revision Hostory:
        Heuijin Ko, 2019.04.02: Created
        Jeonghwan Ju, 2019.04.07: Updated
   ========================================================================== */

/**
 *   Validates when submission.
 *   if have errors, set focus on.
 */

function validatePart()
{
    var focusOn = false;
    var isNoError = true;

    // document.getElementById('myForm').submit();
    // validates 
    if(!isNumber("vendorNo"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("vendorNo").focus();
            focusOn = true;
        }
    }

    if (isEmpty("description"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("description").focus();
            focusOn = true;
        }
    }else if (!checkLength("description", 30))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("description").focus();
            focusOn = true;
        }
    }

    if (!isNumber("onhand"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("onhand").focus();
            focusOn = true;
        }
    }

    if (!isNumber("onorder"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("onorder").focus();
            focusOn = true;
        }
    }

    if (!isPositiveFloat("cost"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("cost").focus();
            focusOn = true;
        }
    }
    
    if (!isPositiveFloat("price"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("price").focus();
            focusOn = true;
        }
    }
    else if(!isValidatePrice())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("price").focus();
            focusOn = true;
        }
    } 

    if(isNoError){  
        // alert('submit');
        document.getElementById('myForm').submit();
    } 
}

function isValidatePrice(){
    var costVal = document.getElementById('cost').value;
    var priceVal = document.getElementById('price').value;
    var errPrice = document.getElementById('price_error');  
    var errLastPrice = document.getElementById('price_c_error');  

    if(!isPositiveFloat('price')){
        return false;
    }
    else{
        errPrice.style="display:none"; 

        if(parseFloat(costVal) >= parseFloat(priceVal)){
            //alert('c :  ' + costVal + ' p : ' + priceVal);
            errLastPrice.style="display:block"; 
            return false;
        }
        else{
            errLastPrice.style="display:none"; 
            return true;
        }
    }
}

function changeVendor(){
     var vendorNo = document.getElementById('vendorNo');

    if(vendorNo.value == ""){
        document.getElementById('vendorNo_error').style = "display:block"; 
        vendorNo.focus();
    }
    else{
        document.getElementById('vendorNo_error').style = "display:none"; 
    }
}

/**
 *   Onload function
 */
/*
window.onload = function()
{   
    // Set focus default control
    document.getElementById('vendorNo').focus();
}
*/