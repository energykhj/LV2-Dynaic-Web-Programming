<?php
/* parts.php
   Assignment 4 - Heuijin Ko(8187452)
   
    Revision Hostory:
        Heuijin Ko, 2019.04.01: Created
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

// partid
if (isset($_POST['partid']))
{
    $partid = trim($_POST['partid']);
}
else
{
    $partid = ""; 
    $isNoError = false;
    $errorMessage[] = "Please enter the part ID.";
}

// vendorNo
if (isset($_POST['vendorNo']))
{
    $vendorNo = trim($_POST['vendorNo']);

    if (!is_numeric($vendorNo))
    {
        $isNoError = false;
        $errorMessage[] = 'Please select one of the venders.';
    }
}
//else
//{
//    $vendorNo = ""; 
//    $isNoError = false;
//    $errorMessage[] = 'Please select one of the venders.';
//}

// description
if (isset($_POST['description']))
{
    $description = trim($_POST['description']);

    if (strlen($description) > 30)
    {
        $isNoError = false;
        $errorMessage[] = 'Cannot allow more than 30 letters. your enter : ' . strlen($description);
    }
    elseif (strlen($description) == 0) {
        $isNoError = false;    
        $errorMessage[] = 'Please enter the description.';
    }
}
else
{
    $description = "";
    $isNoError = false;    
    $errorMessage[] = 'Please enter the description.';
}


// on hand
if (isset($_POST['onhand']))
{
    $onhand = trim($_POST['onhand']);

    // if (!isNumber($onhand))
    if (!is_numeric($onhand))
    {
        $isNoError = false;
        $errorMessage[] = 'On hand quantities only allow the numbers.';
    }
}
else
{
    $onhand = 0;
    $isNoError = false;
    $errorMessage[] = 'Please enter a on hand quantities(only number).';
}


// on order
if (isset($_POST['onorder']))
{
    $onorder = trim($_POST['onorder']);

    // if (!isNumber($onorder))
    if (!is_numeric($onorder))
    {
        $isNoError = false;
        $errorMessage[] = 'On order quantities only allow the positive numbers.';
    }
    elseif ($onorder <= 0)
    {
        $isNoError = false;
        $errorMessage[] = 'On order quantities only allow the positive numbers.';
    }
}
else
{
    $onorder = 0;
    $isNoError = false;
    $errorMessage[] = 'Please enter a on order quantities(only number).';
}

// cost
if (isset($_POST['cost']))
{
    $cost = trim($_POST['cost']);

    // if (!isNumber($onorder))
    if (!is_numeric($cost))
    {
        $isNoError = false;
        $errorMessage[] = 'Cost only allow the positive numbers.';
    }
    elseif ($cost <= 0)
    {
        $isNoError = false;
        $errorMessage[] = 'Cost only allow the positive numbers.';
    }
}
else
{
    $cost = 0;
    $isNoError = false;
    $errorMessage[] = 'Please enter a cost(only positive number).';
}

// price
if (isset($_POST['price']))
{
    $price = trim($_POST['price']);

    // if (!isNumber($price))
    if (!is_numeric($price))
    {
        $isNoError = false;
        $errorMessage[] = 'Last price only allow the positive numbers.';
    }
    elseif ($price <= 0)
    {
        $isNoError = false;
        $errorMessage[] = 'Last price only allow the positive numbers.';
    }
}
else
{
    $price = 0;
    $isNoError = false;
    $errorMessage[] = 'Please enter a last price(only positive number).';
}

// At least one product must be set
if ($cost >= $price) 
{
    $isNoError = false;
    $errorMessage[] = 'Our last price must be more than cost.';
}


////////////////////////////////////////////////////////////
// Html

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assignment4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/assignment4.css" /> 
    <script src="scripts/common.js"></script>
       
</head>
<body>
<div class="form-header">    
    <h2>Insert Part Result</h2>
</div>     
<div class="container">';

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
    $insertResult = insertParts($_POST);
    // echo '<br /><br /><br />';
    
    if ($insertResult == true)
    {
        // Message
        echo '
            <script type="text/javascript">
                alert("Part info registered succsessfully.");
            </script>
        ';

        // Display Invoice
        echo "
            <table id='mytable' style='width:100%;'>
                <tr>
                    <td align='left' width='60%'>Part ID</td>
                    <td width='40%' align='right'>$partid</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Vendor Number</td>
                    <td width='40%' align='right'>$vendorNo</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Description</td>
                    <td width='40%' align='right'>$description</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>On Hand</td>
                    <td width='40%' align='right'>$onhand</td>
                    </td>
                </tr>
                <tr>
                    <td align='left' width='60%'>On Order</td>
                    <td width='40%' align='right'>$onorder</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Cost</td>
                    <td width='40%' align='right'>$" . number_format($cost, 2) . "</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Last Price</td>
                    <td width='40%' align='right'>$" . number_format($price, 2) . "</td>
                </tr>    
            </table>
        ";
    }
    else
    {
        // Message
        echo '
            <script type="text/javascript">
                alert("Failed to register the Part info.");
            </script>
        ';

        // Display Error
        echo "
            <table id='mytable' style='width:100%;'>
                <tr>
                    <td width='40%'>Database Error</td>
                    <td width='60%'>Fail to insert to the database</td>
                </tr>
            </table>
        ";
    }
}
?>
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
<?php



?>

