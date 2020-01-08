/* ==========================================================================
    Heuijin Ko(8187452)
    Javascript for Assginment2
    Computes the sum and average of entered even/odd number respectively.
   ========================================================================== */
var stringResult = '';
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
 *  check email and confirm-email are same.
 */
function emailConfirm(){
    var email = document.getElementById('email');
    var confirmEmail = document.getElementById('emailConfirm');      

    if(email.value != confirmEmail.value){        
        document.getElementById('emailConfirm_error').style="display:block";
        document.getElementById('emailConfirm_error').innerHTML = 
        "Please enter the same email address again.";        
        return false;
    }
    else{
        document.getElementById('emailConfirm_error').style="display:none";          
        
        return true;
    }
}
/**
 *  validate regular expression for email
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
 *  check gender. 
 */
function isCheckedGender(){
    var isChecked = false;
    var gender = document.getElementsByName('gender');

    for(var i = 0; i < gender.length; i++)
    {
        if(gender[i].checked) 
        {
            gender = gender[i].value;
            isChecked = true;
        }
    }

    if(isChecked == false){
        document.getElementById('gender_error').style = "display:block";
        return false;
    } 
    else{
        document.getElementById('gender_error').style = "display:none";
        return gender;
    }
}
/**
 *  when gender was selecte, remove error message.  
 *  1. call from front(html) page.
 */
function setGender(value)
{
    document.getElementById('gender_error').style = "display:none";
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
 *  1. All input fields except radio fields for 'gender' are validated by value.
 *  2. The input values are converted depending on the characteristic of each field. 
 *      - Firstname, Lastname: convert to uppercase & remove white spaces.
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
            case 'firstname':
            case 'lastname':
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
        
        stringResult += field.toUpperCase() + `:    ${id.value} <br/><br/>`;
        return false;
    }
}
/**
*   Validates when submission.
*   if have errors, set focus on.
*/
function submitValidation()
{
    var focusOn = false;
    var isNoError = true;

    //check mandatory    
    if (isEmpty("firstname"))
	{
        isNoError = false;
        if(!focusOn){
            document.getElementById("firstname").focus();
            focusOn = true;
        }
    }
    if (isEmpty("lastname"))
	{
        isNoError = false;
        if(!focusOn){
            document.getElementById("lastname").focus();
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
    if (isEmpty("province"))
	{
        isNoError = false;
        if(!focusOn){
            document.getElementById("province").focus();
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
    // validates phone number
    if(!phoneValidate())
	{ 
        isNoError = false;
        if(!focusOn){
            document.getElementById("phone").focus();
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
    // validates the email-confirm
    if(isValidEmail("emailConfirm"))
    {
        // check two emails are same
        if(!emailConfirm()){
            isNoError = false;
            if(!focusOn){
                document.getElementById("emailConfirm").focus();
                focusOn = true;
            }
        }
    }
    else{
        isNoError = false;
        if(!focusOn){
            document.getElementById("emailConfirm").focus();
            focusOn = true;
        }
    }
    // check gender
    var gender = isCheckedGender();
    if(!gender){
        isNoError = false;
        if(!focusOn){
            document.getElementById("emailConfirm").focus();
            focusOn = true;
        }
    }

    // Display on the screen what user is typed
    if(isNoError){ 
        stringResult = '';   
        var receiveEmail = document.getElementById('receiveMail').checked ? 'YES' : 'NO';
        stringResult = '<div class="container">';
        stringResult += `FIRSTNAME:${document.getElementById('firstname').value} <br/><br/>`;     
        stringResult += `LASTNAME:${document.getElementById('lastname').value} <br/><br/>`;    
        stringResult += `STREET:    ${document.getElementById('address1').value} <br/><br/>`;       
        stringResult += `ADDRESS:    ${document.getElementById('address2').value} <br/><br/>`;    
        stringResult += `CITY:    ${document.getElementById('city').value} <br/><br/>`;    
        stringResult += `PROVINCE:    ${document.getElementById('province').value} <br/><br/>`;       
        stringResult += `POST CODE:    ${document.getElementById('postalcode').value} <br/><br/>`;
        stringResult += `PHONE:    ${document.getElementById('phone').value} <br/><br/>`;    
        stringResult += `EMAIL:    ${document.getElementById('email').value} <br/><br/>`;
        stringResult += `RECEIVE EMAIL:    ${receiveEmail} <br/><br/>`;
        stringResult += `GENDER:    ${gender} <br/><br/></div>`;
    
        document.getElementById('SubmitResult').innerHTML = stringResult;
    
        alert('All fields are validated!!');
    }

    return false;
}
/**
*  Resets all text fields.
*/
function resetAll(){
    stringResult = '';
    document.getElementById('SubmitResult').innerHTML = stringResult;
    var elements = document.getElementsByTagName("input");
    for (var ii=0; ii < elements.length; ii++) {
        if (elements[ii].type == "text" || elements[ii].type == "email") {
            elements[ii].value = "";
        }
        if(elements[ii].type == "checkbox"){
            elements[ii].checked = false;
        }
        if(elements[ii].type == "radio"){
            elements[ii].checked = false;
        }
    }
    document.getElementById("province").selectedIndex = 0;
    resetErrMsg();
    return false;
}
/**
*  Resets all indicated error messages.
*/
function resetErrMsg(){
    var el;
    var allElements = document.getElementsByTagName('*');
    for(var i = 0; i < allElements.length; i++) {
        el = allElements[i].id;
        if(el.indexOf('_') > 0){
            document.getElementById(`${el}`).style = "display:none";
        }
    }
    document.getElementById("firstname").focus();
}
