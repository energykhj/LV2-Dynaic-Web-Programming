
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
 *  validates fax number.
 *  1. format is 555-555-5555
 *  2. can allow only number or '-'
 *  3. Convert phone format to '111-111-1111' if the phone is 10 digits length.
 */
function faxValidate(){
    var faxVal = document.getElementById("fax").value;
    var err = document.getElementById('fax_error');

    // Allow blank value
    if (faxVal == "")
    {
        err.style="display:none";  
        return true;
    }

    var phoneregex =  /\d{3}-\d{3}-\d{4}/;

    if(faxVal.length == 10){
        faxVal = faxVal.substr(0,3) + '-' +  faxVal.substr(3,3) + '-' + faxVal.substr(6);
        document.getElementById("fax").value = faxVal;
    }

    if(phoneregex.test(faxVal)){
        err.style="display:none";  

        return true;
    }else{
        err.style="display:block";         
        return false;
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
    id = document.getElementById('postCode');    
    postalCode = id.value;
    // converts input value(postal code) to uppercase and trimming.
    postalCode = postalCode.toUpperCase().trim(); 

    // var postcoderegex = new RegExp(/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i);
    // N2L0G8 (6 letters)
    var postcoderegex = new RegExp(/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]\d[ABCEGHJKLMNPRSTVWXYZ]\d$/i);

    if (postcoderegex.test(postalCode.toString())) {   
        // inputs the space when length is 6     
        if(postalCode.length == 7 && postalCode.substring(3,1) == ' '){
            postalCode = postalCode.substring(0,3) + postalCode.substring(4);
        }
        id.value = postalCode;
        document.getElementById('postCode_error').style = "display:none"; 
        return true;
    }
    else
    {
        document.getElementById('postCode_error').style = "display:block";
        return false;
    }
}

/**
 *  Country Code validation
 *  Contry code length is 2
 */
function isAvaliableCountryCode(){
    var returnVal = false;

    id = document.getElementById('country');    
    countryCode = id.value;
    
    countryCode = countryCode.toUpperCase().trim(); 

    var countryCodeRe = new RegExp(/^[A-Z]{2}$/i);

    if (countryCodeRe.test(countryCode.toString())) {           
        id.value = countryCode;
        document.getElementById('country_error').style = "display:none"; 
        return true;
    }
    else
    {
        document.getElementById('country_error').style = "display:block";
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

function isNumber(field){
    id = document.getElementById(`${field}`);
    err = document.getElementById(`${field+'_error'}`);

    var pattern = (field == 'onhand') ? /^-?\d*$/ : /^\d*$/;
    var numRx = new RegExp(pattern);

    id.value = id.value.trim();
    if(id.value == "" || isNaN(id.value))
    { 
        err.style="display:block";         
        return false;
    }
    else if(numRx.test(id.value)){
            err.style="display:none";  
            return true;
    }
    else
    {               
        err.style="display:block";  
        return false;
    }
}

function isPositiveFloat(field){
    id = document.getElementById(`${field}`);
    err = document.getElementById(`${field+'_error'}`);

    // Positive Float Pattern
    var pattern = /^\d*(\.\d+)*$/;

    var numRx = new RegExp(pattern);

    id.value = id.value.trim();

    if(id.value == "" || isNaN(id.value))
    { 
        err.style="display:block";     
        return false;
    }
    else if(numRx.test(id.value)){
        err.style="display:none";  
        return true;
    }
    else
    {               
        err.style="display:block";  
        return false;
    }
}

function popupWin(which){
    var w = 800;
    var h = 850;

    // var URL = (which == 'part') ? "parts.php" : "vendor.php";
    var URL = "";

    if (which == "part")
    {
        URL = "partsForm.php";        
    }
    else if (which == "vendor")
    {
        URL = "vendorsForm.php"; 
    }
    else if (which == "parameter")
    {
        URL = "parameterForm.php"; 
        
        var w = 1200;
        var h = 850;
    }

    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2)-20;
    var newWindow = window.open(URL, which, 'width='+ w +', height='+ h +', top='+top+', left='+left);

    if (window.focus) newWindow.focus();

    return newWindow;
 }


/*
*   check length 
*/
function checkLength(field, len){
    id = document.getElementById(`${field}`);
    err = document.getElementById(`${field+'_error'}`);

    if(id.value.length > len ){
         err.style="display:block"; 
        return false;
    }
    else
    {               
        err.style="display:none";  
        return true;
    }
}

function closeWindow() {
	self.close();
}