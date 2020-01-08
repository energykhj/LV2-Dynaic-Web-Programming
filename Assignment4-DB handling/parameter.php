<?php
/* parts.php
   Assignment 4 - Heuijin Ko(8187452)
   
    Revision Hostory:
        Heuijin Ko, 2019.04.07: Created
*/ 

// include("model.php");
include("functions.php");

////////////////////////////////////////////////////////////

/*
echo "<xmp>";
print_r($_POST);
echo "</xmp>";
// exit;
*/

$isNoError = true;
$errorMessage = array();                // Initialize array

// Search Type
if (isset($_POST['searchType']))
{
    $searchType = trim($_POST['searchType']);

    switch ($searchType)
    {
        case "everything":
        case "parts":
        case "vendors":

            break;

        default:
            $searchType = ""; 
            $isNoError = false;
            $errorMessage[] = "Please enter the List (Search Type).";
        
            break;
    }
}
else
{
    $searchType = ""; 
    $isNoError = false;
    $errorMessage[] = "Please enter the List (Search Type).";
}

// Description
if (isset($_POST['description']))
{
    $description = trim($_POST['description']);
}
else
{
    $description = "";
}

// Vendor Name
if (isset($_POST['vendorName']))
{
    $vendorName = trim($_POST['vendorName']);
}
else
{
    $vendorName = "";
}

// Search Value
if (isset($_POST['searchVal']))
{
    $searchVal = trim($_POST['searchVal']);
}
else
{
    $searchVal = "";
}

////////////////////////////////////////////////////////////
// Html


////////////////////////////////////////////////////////////
// Show Error 

if (!$isNoError)
{
    echo "
        <table id='mytable'>
            <tr>
                <th width='100%' colspan='2'>Error list</th>
            </tr>
    ";

    $no = 0;

    foreach ($errorMessage as $error)
    {
        $no++;

        echo "
            <tr>
                <td align='center' width='20%'>$no</td>
                <td width='80%'align='left'>$error</td>
            </tr>
        ";
    }

    echo "
        </table>
    ";
}
else                                    // No Error
{
    // Sub title
    if ($searchType == "everything") 
    {
        $subTitle = "SEARCH";
        $searchLabel = "EVERYTHING<br />(VENDOR NAME<br />or DESCRIPTION)";
    }
    elseif ($searchType == "parts") 
    {
        $subTitle = "SEARCH PARTS";
        $searchLabel = "DESCRIPTION";
    }
    elseif ($searchType == "vendors") 
    {
        $subTitle = "SEARCH VENDORS";
        $searchLabel = "VENDOR NAME";
    }
    else
    {
        $subTitle = "";
        $searchLabel = "";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assignment4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/assignment4.css" />
    <script src="scripts/common.js"></script>
    <script src="scripts/parameter.js"></script>
</head>
<body>
<div class="form-header">    
    <h2><?php echo $subTitle; ?></h2>
    <section class="explain">
        <h5 class="text-explain">- Enter keywork and click 'SEARCH' button.</h5>
    </section>
</div>  
    <form id="myForm" name="myForm" method="POST" action="parameter.php">
        <input type="hidden" id="searchType" name="searchType" value="<?php echo $searchType; ?>" />
        
        <!-- Search Type block start -->
        <div class="row"> 
            <div class="form-group width45">
                <div class="style-select">                    
                    <label><?php echo $searchLabel; ?></label> :
                    <input type="text" class="form-control" id="searchVal" name="searchVal" value="<?php echo $searchVal; ?>" />
                </div>
            </div>  
            <div class="form-error width45">
                <div id="searchVal_error" class="errMsg" style="display:none">Please enter the keyword (Search Value).</div>
            </div>  
        </div> 
        <!-- Search Type block end -->
        <div class="row">
            <div class="form-item">
                <input type="button" class="submit" value="SEARCH" onclick="search();" />
            </div>
        </div>    
        <!-- submit block end -->	
    
<?php
    // Initialize
    $searchParam = array();

    $searchParam["search"] = $searchType;
    $searchParam["searchVal"] = $searchVal;

    // Display data
    SearchbyValue($searchParam);
}
?>
    </form>

        <hr class="reduced-margin">
        <!-- button block start -->
        <div class="row">
            <div class="form-item">
                <input type="button" class="submit" value="Close" onclick="closeWindow();" />
            </div>
        </div>    
        <!-- button block end -->
    </div>
</body>
</html>
