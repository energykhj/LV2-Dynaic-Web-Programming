/* ==========================================================================
    Heuijin Ko(8187452)
    Javascript for Assginment1
    Computes the sum and average of entered even/odd number respectively.
   ========================================================================== */

/**
 *  Declaration of global variable
 */
var OddSum = 0;
var EvenSum = 0;
var OddCnt = 0;
var EvenCnt = 0;
var cnt = 0;
var tblheader = "<tr><th>&nbsp;</th><th>Odd</th><th>Even</th></tr>";
var tblBody = '';

/**
 *  Erase and focus on entered input values for re-enter.
 */
function clearInputbox(){
    var inputCtl = document.getElementById('inputnum');
        inputCtl.value = '';
        inputCtl.focus();
}

/**
 *  Validation of Input Values
 *  1. Do not allow 0’s
 *  2. Accepted only numeric data
 */
function InputValidation(Val){

    if(isNaN(Val)){
        var Msg = '<font class=\'msg\'>Only numbers are allowed, try again!</font>';
        document.getElementById('errorMsg').innerHTML = Msg;
        clearInputbox();
        return false;
    }
    else if(Val == 0){
        var Msg = '<font class=\'msg\'>0 is not allowed, try again!</font>';
        document.getElementById('errorMsg').innerHTML = Msg;
        clearInputbox();
        return false;
    }
    document.getElementById('errorMsg').innerHTML = '';
    return true;
}
/**
 *  Making the footer of table.
 *  1. Divided by 0 is not allowed.
 *  2. Making the 3 last rows for the count of odd/even numbers, sum, and average
 *  3. The average is displayed up to the second decimal place.
 *  4. Display and calculating with stored global variables.
 */
function makeTblFooter(){
    var OddAvg = (OddCnt > 0)? OddSum/OddCnt : 0;
    var EvenAvg = (EvenCnt > 0)? EvenSum/EvenCnt : 0;
    
    var tblFooter = `<tr>
                        <td>Count</td>
                        <td>${OddCnt}</td>
                        <td>${EvenCnt}</td>
                    </tr>
                    <tr>
                        <td>Sum</td>
                        <td>${OddSum}</td>
                        <td>${EvenSum}</td>
                    </tr>
                    <tr>
                        <td>Average</td>
                        <td>${OddAvg.toFixed(2)}</td>
                        <td>${EvenAvg.toFixed(2)}</td>
                    </tr>`;
    return tblFooter;
}
/**
 *  Drawing the table.
 *  1. Separating the numbers provided into even and odd groups.
 *  2. Validation of entered values.
 *  3. Calculating as much as the user wanted.
 *  4. All values are stored the global variables.
 */
function drawTable(){
    var Num = parseInt(document.getElementById('inputnum').value);
    if(!InputValidation(Num)) return;

    cnt++;            
    if(Num % 2 == 1){
        OddCnt++;
        OddSum += Num;
        tblBody += `<tr>
                        <td>${cnt}</td>
                        <td>${Num}</td>
                        <td>&nbsp;</td>
                    </tr>`;
    }
    else{
        EvenCnt++;
        EvenSum += Num;
        tblBody += `<tr>
                        <td>${cnt}</td>
                        <td>&nbsp;</td>
                        <td>${Num}</td>
                    </tr>`;
    }
    
    var tblString = tblheader + tblBody + makeTblFooter();
    document.getElementById('tableData').innerHTML = tblString;
    
    clearInputbox();
}
/**
 *  To reset the table
 *  1. Ask the user for confirmation.
 *  2. Initializes the global variables.
 *  3. Clear table and input field.
 */
function resetTable(){
    var txt;
    if (confirm("Do you want to reset? If press `OK`, table will be cleared!")) {
        OddSum = 0;
        EvenSum = 0;
        OddCnt = 0;
        EvenCnt = 0;
        cnt = 0;
        tblBody = '';
        document.getElementById('tableData').innerHTML = "";
        clearInputbox();
    } 
}
/**
 * 
 * if enter key is press, excute drawTable(); 
 */
function KeyPress(e) {
    if (e.keyCode == 13) {
        drawTable();
        return false;
    }
}