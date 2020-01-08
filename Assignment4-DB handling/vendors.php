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

// Vendor Number
if (isset($_POST['vendorNumber']))
{
    $vendorNumber = trim($_POST['vendorNumber']);
}
else
{
    $vendorNumber = ""; 
    $isNoError = false;
    $errorMessage[] = "Please enter the Vendor Number.";
}

// Vendor Name
if (isset($_POST['vendorName']))
{
    $vendorName = trim($_POST['vendorName']);

    if (strlen($vendorName) > 30)
    {
        $isNoError = false;
        $errorMessage[] = 'Vendor Name cannot allow more than 30 letters. your enter : ' . strlen($vendorName);
    }
}

// Address 1
if (isset($_POST['address1']))
{
    $address1 = trim($_POST['address1']);

    if (strlen($address1) > 30)
    {
        $isNoError = false;
        $errorMessage[] = 'Address 1 cannot allow more than 30 letters. your enter : ' . strlen($address1);
    }
    elseif (strlen($address1) == 0) {
        $isNoError = false;    
        $errorMessage[] = 'Please enter the Address 1.';
    };
}
else
{
    $description = "";
    $isNoError = false;    
    $errorMessage[] = 'Please enter the Address 1.';
}

// Address 2
if (isset($_POST['address2']))
{
    $address2 = trim($_POST['address2']);

    if (strlen($address2) > 30)
    {
        $isNoError = false;
        $errorMessage[] = 'Address 2 cannot allow more than 30 letters. your enter : ' . strlen($address2);
    }
}

// City
if (isset($_POST['city']))
{
    $city = trim($_POST['city']);

    if (strlen($city) > 20)
    {
        $isNoError = false;
        $errorMessage[] = 'City cannot allow more than 20 letters. your enter : ' . strlen($city);
    }
    elseif (strlen($city) == 0) {
        $isNoError = false;    
        $errorMessage[] = 'Please enter the City.';
    };
}
else
{
    $description = "";
    $isNoError = false;    
    $errorMessage[] = 'Please enter the City.';
}

// Province
if (isset($_POST['province']))
{
    $province = trim($_POST['province']);

    if (!checkProvinceCode($province))
    {
        $isNoError = false;
        $errorMessage[] = 'Please select a province.';
    }
}
else
{
    $description = "";
    $isNoError = false;    
    $errorMessage[] = 'Please select a province.';
}

// Post Code
if (isset($_POST['postCode']))
{
    $postCode = trim($_POST['postCode']);

    if (!checkPostalCodeFormat($postCode))
    {
        $isNoError = false;
        $errorMessage[] = 'Plaeas enter the Post Code.';
    }
}
else
{
    $description = "";
    $isNoError = false;    
    $errorMessage[] = 'Plaeas enter the Post Code.';
}

// Country Code
if (isset($_POST['country']))
{
    $country = trim($_POST['country']);

    if (!checkCountryCode($country))
    {
        $isNoError = false;
        $errorMessage[] = 'Please enter a country code ex) CA.';
    }
}
else
{
    $description = "";
    $isNoError = false;    
    $errorMessage[] = 'Please enter a country code ex) CA.';
}

// Phone
if (isset($_POST['phone']))
{
    $phone = trim($_POST['phone']);

    if (!checkPhoneFormat($phone))
    {
        $isNoError = false;
        $errorMessage[] = 'Please enter a phone number ex) 123-456-7890.';
    }
}
else
{
    $description = "";
    $isNoError = false;    
    $errorMessage[] = 'Please enter a phone number ex) 123-456-7890.';
}

// Fax
if (isset($_POST['fax']))
{
    $fax = trim($_POST['fax']);

    if (strlen($fax) > 0)
    {
        if (!checkPhoneFormat($fax))
        {
            $isNoError = false;
            $errorMessage[] = 'Please enter a fax number ex) 123-456-7890.';
        }
    }    
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
    <h2>Insert Vendor Result</h2>
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
    $insertResult = insertVendors($_POST);
    // echo '<br /><br /><br />';
    
    if ($insertResult == true)
    {
        // Message
        echo '
            <script type="text/javascript">
                alert("Vendor info registered succsessfully.");
            </script>
        ';

        // Display Invoice
        echo "
            <table id='mytable' style='width:100%;'>
                <tr>
                    <td align='left' width='60%'>Vendor Number</td>
                    <td width='40%' align='right'>$vendorNumber</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Vendor Name</td>
                    <td width='40%' align='right'>$vendorName</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Address 1</td>
                    <td width='40%' align='right'>$address1</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Address 2</td>
                    <td width='40%' align='right'>$address2</td>
                    </td>
                </tr>
                <tr>
                    <td align='left' width='60%'>City</td>
                    <td width='40%' align='right'>$city</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Province</td>
                    <td width='40%' align='right'>$province</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Post Code</td>
                    <td width='40%' align='right'>$postCode</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Country Code</td>
                    <td width='40%' align='right'>$country</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Phone</td>
                    <td width='40%' align='right'>$phone</td>
                </tr>
                <tr>
                    <td align='left' width='60%'>Fax</td>
                    <td width='40%' align='right'>$fax</td>
                </tr>
                
                
            </table>
        ";
    }
    else
    {
        // Message
        echo '
            <script type="text/javascript">
                alert("Failed to register the Vendor info.");
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
