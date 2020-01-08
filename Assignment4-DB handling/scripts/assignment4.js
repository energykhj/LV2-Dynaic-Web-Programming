/* ==========================================================================
    Heuijin Ko(8187452), Jeonghwan Ju(8227969)
    Javascript for Assginment4   
    My Shop

    Revision Hostory:
        Heuijin Ko, 2019.04.02: Created
   ========================================================================== */

/**
 *   Validates when submission.
 *   if have errors, set focus on.
 */

function validatePart()
{
    var focusOn = false;
    var isNoError = true;


    // validates email address
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

    if (!isNumber("cost"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("cost").focus();
            focusOn = true;
        }
    }
    
    if (!isNumber("price"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("price").focus();
            focusOn = true;
        }
    }
    
    if(!isValidatePrice())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("price").focus();
            focusOn = true;
        }
    } 

    if(isNoError){  
        document.getElementById('myForm').submit();
    } 
}

function validateVendor()
{
    var focusOn = false;
    var isNoError = true;

    //check mandatory    
    if (isEmpty("name"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("name").focus();
            focusOn = true;
        }
    }
    // validates email address
    if(!isValidEmail("email"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("email").focus();
            focusOn = true;
        }
    }
    // validates phone number
    if(!phoneValidate())
    { 
        isNoError = false;
        if(!focusOn){
            document.getElementById("phone").focus();
            focusOn = true;
        }
    }
    if (isEmpty("address1"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("address1").focus();
            focusOn = true;
        }
    }
    if (isEmpty("city"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("city").focus();
            focusOn = true;
        }
    }
    // validates postal code
    if(!isAvaliablePC())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("postalcode").focus();
            focusOn = true;
        }
    }  
    if (isEmpty("province"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("province").focus();
            focusOn = true;
        }
    }

    if (!checkPrice())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("product1").focus();
            focusOn = true;
        }
    } 

    if(isNoError){  
        document.getElementById('myForm').submit();
    }    
}

function changeSearchTag(){
    document.getElementById('searchVal').focus();
}

/**
 *  Whenever province was changed, checks its availability
 */
function changeVendor(){
    var vendorName = document.getElementById('vendorName');

    if(vendorName.value == ""){
        // If not selcted, an error message display below the province 
        document.getElementById('vendorName_error').style = "display:block"; 
        vendorName.focus();
    }
    else{
        document.getElementById('vendorName_error').style = "display:none"; 
    }
}

function isValidatePrice(){
    var costVal = document.getElementById('cost').value;
    var priceVal = document.getElementById('price').value;
    var errPrice = document.getElementById('price_error');  
    var errLastPrice = document.getElementById('price_c_error');  

    if(!isNumber('price')){
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
}6
}
   
/**
 *   Onload function
 */
window.onload = function()
{   
    // Set focus default control
    //document.getElementById('vendorNo').focus();
}