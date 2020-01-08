/* ==========================================================================
    Heuijin Ko(8187452), Jeonghwan Ju(8227969)
    Javascript for Assginment4   
    My Shop

    Revision Hostory:
        Jeonghwan Ju, 2019.04.07: Created
   ========================================================================== */

/**
 *   Validates when submission.
 *   if have errors, set focus on.
 */

function validateVendor()
{
    var focusOn = false;
    var isNoError = true;

    // document.getElementById('myForm').submit();
    if(!isNumber("vendorNumber"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("vendorNumber").focus();
            focusOn = true;
        }
    }
    
    if (isEmpty("vendorName"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("vendorName").focus();
            focusOn = true;
        }
    }
    else if (!checkLength("vendorName", 30))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("vendorName").focus();
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
    else if (!checkLength("address1", 30))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("address1").focus();
            focusOn = true;
        }
    }

    if (!checkLength("address2", 30))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("address2").focus();
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
    else if (!checkLength("city", 20))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("city").focus();
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
    else if (!checkLength("province", 2))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("province").focus();
            focusOn = true;
        }
    }

    // Post Code
    if (!isAvaliablePC())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("postCode").focus();
            focusOn = true;
        }
    }

    if (!isAvaliableCountryCode())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("country").focus();
            focusOn = true;
        }
    }

    if (!phoneValidate())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("phone").focus();
            focusOn = true;
        }
    }

    if (!faxValidate())
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("fax").focus();
            focusOn = true;
        }
    }

    if(isNoError){  
        // alert('submit');
        document.getElementById('myForm').submit();
    } 
}

function changeProvince(){
    var province = document.getElementById('province');

   if(province.value == ""){
       document.getElementById('province_error').style = "display:block"; 
       province.focus();
   }
   else{
       document.getElementById('province_error').style = "display:none"; 
   }
}
