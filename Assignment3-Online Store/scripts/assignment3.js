/* ==========================================================================
    Heuijin Ko(8187452), Jeonghwan Ju(8227969)
    Javascript for Assginment3    
    My Shop

    Revision Hostory:
        Heuijin Ko, 2019.03.22: Created
        Jeonghwan Ju, 2019.03.24: Updated
   ========================================================================== */

/**
 *   Validates when submission.
 *   if have errors, set focus on.
 */
function submitValidation()
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

    if (!validateProduct("product1"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("product1").focus();
            focusOn = true;
        }
    } 
    if (!validateProduct("product2"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("product2").focus();
            focusOn = true;
        }
    } 
    if (!validateProduct("product3"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("product3").focus();
            focusOn = true;
        }
    } 
    if (!checkProduct())
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
/**
*  convert to uppercase.
*/
function convertUpperCase(_ctr){    
    _ctr.value = _ctr.value.toUpperCase();
}
/**
 *  Remove whitespaces in the first and last of words.
 *  ^       start postion of a line
 *  \s+     matches any whitespace character (i.g: \r\n\t\f\v)
 *  $       end position of a line
 *  g       All matches
 */
function removeWhiteSpaces(_ctr){
    _ctr.value = _ctr.value.replace(/^\s+|\s+$/g,'');
}
/**
 *  Convert the first character to uppercase.
 *  1. \D  find a non-digit character.
 *  2. if field is address, 
 *      - convert the first letter of the address except for the street number to uppercase.
 *          e.g.) 299 doon valley -> 299 Doon valley
 */
function convertFist2CapitalLetter(_ctr){
    var str = _ctr.value; 
    var patt1 = /\D+/;
    var numberPart = -1;
    var startPos = 0;

    if(str.match(patt1) != null)
        startPos = str.match(patt1).index;

    // check whether field is address or city
    if(startPos >= 0){   
        numberPart = str.substring(0, startPos); // if address, keep number part of address

        if(str.charAt(startPos) == ' '){
            startPos += 1;
        };
        _ctr.value = numberPart + ' ' + str.charAt(startPos).toUpperCase() + str.substring(startPos+1);
    }
    else // if city, only the first letter is changed to the capital letter.
    _ctr.value = _ctr.value.charAt(0).toUpperCase() + _ctr.value.substring(1);
}
/**
 *  Whenever province was changed, checks its availability
 */
function changeProvince(){
    var province = document.getElementById('province');

    if(province.value == ""){
        // If not selcted, an error message display below the province 
        document.getElementById('province_error').style = "display:block"; 
        province.focus();
    }
    else{
        document.getElementById('province_error').style = "display:none"; 
    }
}
/**
 *  validates phone number.
 *  1. format is 555-555-5555
 *  2. can allow only number or '-'
 *  3. Convert phone format to '111-111-1111' if the phone is 10 digits length.
 */
function phoneValidate(){
    var phoneVal = document.getElementById("phone").value;
    var err = document.getElementById('phone_error');
    var phoneregex =  /\d{3}-\d{3}-\d{4}/;

    if(phoneVal.length == 10){
        phoneVal = phoneVal.substr(0,3) + '-' +  phoneVal.substr(3,3) + '-' + phoneVal.substr(6);
        document.getElementById("phone").value = phoneVal;
    }

    if(phoneregex.test(phoneVal)){
        err.style="display:none";  

        return true;
    }else{
        err.style="display:block";         
        return false;
    }
}
/**
 *  Validate regular expression for email
 *  1. remove white spaces. 
 *  2. expression : include '@' and '.'
 *  3. 'aaa@aaa.' is error, format is test@example.ca
 */
function isValidEmail(ctr) {
    removeWhiteSpaces(document.getElementById(`${ctr}`));

    var inputVal = document.getElementById(`${ctr}`).value;
    var errCtr = document.getElementById(`${ctr+'_error'}`);  

    atpos =  inputVal.indexOf("@");
    dotpos =  inputVal.lastIndexOf(".");

    if (atpos < 1 || ( dotpos - atpos < 2 ) ||
    inputVal.substring(dotpos).length <= 1)
    {        
        errCtr.style = "display:block";   
        // document.getElementById(`${ctr}`).focus();        
        return false;
    }
    else{        
        errCtr.style = "display:none";
        return true;
    }
}
/**
 *  Postal code validation
 *  1. postal code length is 7. 
 *      - the middle of postal code has space.
 *      - Ultimately, completes the postal code with space.
 */
function isAvaliablePC(){
    var returnVal = false;
    id = document.getElementById('postalcode');    
    postalCode = id.value;
    // converts input value(postal code) to uppercase and trimming.
    postalCode = postalCode.toUpperCase().trim(); 

    var postcoderegex = new RegExp(/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i);
    if (postcoderegex.test(postalCode.toString())) {   
        // inputs the space when length is 6     
        if(postalCode.length == 6){
            postalCode = postalCode.substring(0,3) + ' ' + postalCode.substring(3);
        }
        id.value = postalCode;
        document.getElementById('postalcode_error').style = "display:none"; 
        return true;
    }
    else
    {
        document.getElementById('postalcode_error').style = "display:block";
        return false;
    }
}
/**
 *  Check mandatory fields
 *  1. The input values are converted depending on the characteristic of each field. 
 *      - name: convert to uppercase & remove white spaces.
 *      - address1: remove white spaces & The first letter of the address except the 
 *                      street number is converted to upper case.
    - city: remove white spaces & The first letter is converted to uppercase. 
*/
function isEmpty(field){
    id = document.getElementById(`${field}`);
    err = document.getElementById(`${field+'_error'}`);

    if(id.value == "")
    {
        err.style="display:block"; 
        return true;
    }
    else {
        err.style="display:none"; 
        switch(field){
            case 'name':
                convertUpperCase(id);
                removeWhiteSpaces(id);
                break;
            case 'address1':        
            case 'city':
                removeWhiteSpaces(id);
                convertFist2CapitalLetter(id);            
                break;
            default:
                break;
        }        
        
        return false;
    }
}
function checkProduct(){
    var product1 = document.getElementById('product1').value;
    var product2 = document.getElementById('product2').value;
    var product3 = document.getElementById('product3').value;
    var productError = document.getElementById('product_error');  

    if(product1 == "0") product1 = "";
    if(product2 == "0") product2 = "";
    if(product3 == "0") product3 = "";
    var x = document.getElementsByClassName("product_label")[0];

    if(product1 == "" && product2 == "" && product3 == ""){
        for(var i = 0; i < 3; i++){
            document.getElementsByClassName("product_label")[i].style.color='#2e20ec';
            document.getElementsByClassName("form-control")[i+6].style.borderColor='#2e20ec';
        }
        productError.style="display:block"; 
        return false;
    }
    else{            
        for(var i = 0; i < 3; i++){
            document.getElementsByClassName("product_label")[i].style.color='black';
            document.getElementsByClassName("form-control")[i+6].style.borderColor='#cccccc';
        }
        productError.style="display:none"; 
        return true;
    }
}
function validateProduct(ctr){
    var inputVal = document.getElementById(`${ctr}`).value;
    var errCtr = document.getElementById(`${ctr+'_error'}`);  
    
    if((inputVal != "") && isNaN(inputVal)){
        errCtr.style="display:block"; 
        document.getElementById(`${ctr}`).focus();
        return false;
    }
    else if((inputVal != "") && (inputVal < 0)){
        errCtr.style="display:block"; 
        document.getElementById(`${ctr}`).focus();
        return false;
    }
    else{        
        errCtr.style="display:none"; 
        return true;
    }
}

/**
 *   Onload function
 */
window.onload = function()
{   
    // Set focus default control
    document.getElementById('name').focus();
}