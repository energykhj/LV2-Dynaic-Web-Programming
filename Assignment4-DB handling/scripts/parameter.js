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

function validateParameter()
{
    var focusOn = false;
    var isNoError = true;

    if (isEmpty("searchType"))
    {
        isNoError = false;
        if(!focusOn){
            document.getElementById("searchType").focus();
            focusOn = true;
        }
    }
    else 
    {
        var searchTypeValue = document.getElementById("searchType").value;
        
        searchTypeValue = searchTypeValue.trim();           // trim

        switch (searchTypeValue)
        {
            case "everything":
            case "parts":
            case "vendors":
                isNoError = true;
                break;

            default:
                isNoError = false;

                if(!focusOn){
                    document.getElementById("searchType").focus();
                    focusOn = true;
                }

                break;
        }
    }

    if(isNoError){  
        // alert('submit');
        document.getElementById('myForm').submit();
    } 
}

function changeSearchType(){
    var searchType = document.getElementById('searchType');

    if (searchType.value == ""){
        document.getElementById('searchType_error').style = "display:block"; 
        province.focus();
    }
    else 
    {
        document.getElementById('searchType_error').style = "display:none"; 
    }
}

// Form submit
function search()
{
    document.getElementById("myForm").submit();
}
