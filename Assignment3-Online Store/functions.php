<?php
/* function.php
   Assignment 3 - Heuijin Ko(8187452)
   
    Revision History 
        Heuijin Ko, 2019.03.22: Created
*/

////////////////////////////////////////////////////////////
// Global variables
$UNIT_PRICE_PRODUCT1 = 10;
$UNIT_PRICE_PRODUCT2 = 20;
$UNIT_PRICE_PRODUCT3 = 30;

////////////////////////////////////////////////////////////
// Function

// Check email format
function checkEmailFormat($email)
{
    $checkFormat = false;

    // Regular expression pattern
    $patten = "/^[a-zA-Z0-9_.-]+@([a-zA-Z0-9-]+.)+[a-z]{2,4}$/";
    $subject = $email;

    // If pattern is matched, return 1 otherwise 0 or false.
    $match = preg_match($patten, $subject);

    if ($match)
    {
        $checkFormat = true;
    }
    else
    {
        $checkFormat = false;
    }

    return $checkFormat;
}

// Check phone format
function checkPhoneFormat($phone)
{
    $checkFormat = false;

    // Regular expression pattern
    $patten = "/^\d{3}-\d{3}-\d{4}$/";
    $subject = $phone;

    // If pattern is matched, return 1 otherwise 0 or false.
    $match = preg_match($patten, $subject);

    if ($match)
    {
        $checkFormat = true;
    }
    else
    {
        $checkFormat = false;
    }

    return $checkFormat;
}

// Check postal code format
function checkPostalCodeFormat($postalCode)
{
    $checkFormat = false;

    // Regular expression pattern
    $patten = "/^[ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ]( )?\d[ABCEGHJKLMNPRSTVWXYZ]\d$/";
    $subject = $postalCode;

    // If pattern is matched, return 1 otherwise 0 or false.
    $match = preg_match($patten, $subject);

    if ($match)
    {
        $checkFormat = true;
    }
    else
    {
        $checkFormat = false;
    }

    return $checkFormat;
}

// Check province code (Canada)
function checkProvinceCode($provinceCode)
{
    $checkResult = false;

    // Province code list
    $canadaProvinceCodeArray = array (
        "AB",
        "BC",
        "MB",
        "NB",
        "NL",
        "NS",
        "NT",        
        "NU",
        "ON",
        "PE",
        "QC",
        "SK",
        "YT"
    );

    if (in_array($provinceCode, $canadaProvinceCodeArray))
    {
        $checkResult = true;
    }
    else
    {
        $checkResult = false;
    }

    return $checkResult;    
}

// Get Province name by code
function getProvinceName($provinceCode)
{
    $provinceName = "";

    // Province List
    $canadaProvinceArray = array (
        "AB" => "Alberta",
        "BC" => "British Columbia",
        "MB" => "Manitoba",
        "NB" => "New Brunswick",
        "NL" => "Newfoundland and Labrador",
        "NS" => "Nova Scotia",
        "NT" => "Northwest Territories",
        "NU" => "Nunavut",
        "ON" => "Ontario",
        "PE" => "Prince Edward Island",
        "QC" => "Quebec",
        "SK" => "Saskatchewan",
        "YT" => "Yukon"
    );

    $provinceName = $canadaProvinceArray[$provinceCode];

    return $provinceName;
}

// Calculate the shipping cost
function calDeliveryFee($delivery)
{
    $deliveryFee = 0;

    if ($delivery == 1)
    {
        $deliveryFee = 30;
    }
    elseif ($delivery == 2)
    {
        $deliveryFee = 25;
    }
    elseif ($delivery == 3)
    {
        $deliveryFee = 20;
    }
    elseif ($delivery == 4)
    {
        $deliveryFee = 15;
    }

    return $deliveryFee;
}

// Get tax rate by province
function getTaxRate($provinceCode)
{
    $taxRate = 0;

    // Tax rate by province
    switch ($provinceCode)
    {
        case "AB":                      // Alberta
        case "NT":                      // Northwest Territories
        case "NU":                      // Nunavut
        case "YT":                      // Yukon
            $taxRate = 0.05;

            break;

        case "SK":                      // Saskatchewan
            $taxRate = 0.11;

            break;

        case "BC":                      // British Columbia 
            $taxRate = 0.12;

            break;
        
        case "MB":                      // Manitoba
        case "ON":                      // Ontario
            $taxRate = 0.13;

            break;

        case "QC":                      // Québec
            $taxRate = 0.14975;

            break;
        
        case "NB":                      // New-Brunswick
        case "NL":                      // Newfoundland and Labrador
        case "NS":                      // Nova Scotia
        case "PE":                      // Prince Edward Island
            $taxRate = 0.15;

            break;

        default:
            $taxRate = 0.13;            // Ontario (default)

            break;
    }

    return $taxRate;
}

// Function
////////////////////////////////////////////////////////////

/*
echo "<xmp>";
print_r($_POST);
echo "</xmp>";
*/

$isNoError = true;
$errorMessage = array();                // Initialize array

// Name
if (isset($_POST['name']))
{
    $name = trim($_POST['name']);
}
else
{
    $name = "";
}

if ($name == "")
{
    $isNoError = false;
    $errorMessage[] = "Please enter your name.";
}

// Email Address
if (isset($_POST['email']))
{
    $email = trim($_POST['email']);
}
else
{
    $email = "";
}

if ($email == "")
{
    $isNoError = false;
    $errorMessage[] = 'Please enter a valid email address using the format "test@example.ca".';
}
else
{
    if (!checkEmailFormat($email))
    {
        $isNoError = false;
        $errorMessage[] = 'Please enter a valid email address using the format "test@example.ca".';
    }
}

// Phone Number
if (isset($_POST['phone']))
{
    $phone = trim($_POST['phone']);
}
else
{
    $phone = "";
}

if ($phone == "")
{
    $isNoError = false;
    $errorMessage[] = 'Please enter a valid phone number using format 555-555-5555.';
}
else
{
    if (!checkPhoneFormat($phone))
    {
        $isNoError = false;
        $errorMessage[] = 'Please enter a valid phone number using format 555-555-5555.';
    }
}

// Address
if (isset($_POST['address1']))
{
    $address1 = trim($_POST['address1']);
}
else
{
    $address1 = "";
}

if ($address1 == "")
{
    $isNoError = false;
    $errorMessage[] = 'Please enter a address.';
}

// City
if (isset($_POST['city']))
{
    $city = trim($_POST['city']);
}
else
{
    $city = "";
}

if ($city == "")
{
    $isNoError = false;
    $errorMessage[] = 'Please enter a city name.';
}

// Postal Code
if (isset($_POST['postalcode']))
{
    $postalcode = trim($_POST['postalcode']);
}
else
{
    $postalcode = "";
}

if ($postalcode == "")
{
    $isNoError = false;
    $errorMessage[] = 'Please enter a valid Postal code using the format "A0A 0A0".';
}
else
{
    if (!checkPostalCodeFormat($postalcode))
    {
        $isNoError = false;
        $errorMessage[] = 'Please enter a valid Postal code using the format "A0A 0A0".';
    }
}

// Province
if (isset($_POST['province']))
{
    $province = trim($_POST['province']);
}
else
{
    $province = "";
}

if ($province == "")
{
    $isNoError = false;
    $errorMessage[] = 'Please select a province name.';
}
else
{
    if (!checkProvinceCode($province))
    {
        $isNoError = false;
        $errorMessage[] = 'Please select a province name.';
    }
}

// PRODUCT 1, PRODUCT 2, PRODUCT 3
// PRODUCT 1
if (isset($_POST['product1']))
{
    $product1 = trim($_POST['product1']);
}
else
{
    $product1 = 0;
}

if ( ($product1 != "") && (!is_numeric($product1)) )
{
    $isNoError = false;
    $errorMessage[] = 'Only allow the positive numbers (Product1).';
}

// PRODUCT 2
if (isset($_POST['product2']))
{
    $product2 = trim($_POST['product2']);
}
else
{
    $product2 = 0;
}

if ( ($product2 != "") && (!is_numeric($product2)) )
{
    $isNoError = false;
    $errorMessage[] = 'Only allow the positive numbers (Product2).';
}

// PRODUCT 3
if (isset($_POST['product3']))
{
    $product3 = trim($_POST['product3']);
}
else
{
    $product3 = 0;
}

if ( ($product3 != "") && (!is_numeric($product3)) )
{
    $isNoError = false;
    $errorMessage[] = 'Only allow the positive numbers (Product3).';
}

// At least one product must be set
if ( ($product1 > 0) || ($product2 > 0) || ($product3 > 0) )
{
    // OK
}
else
{
    $isNoError = false;
    $errorMessage[] = 'You must buy one of the products.';
}

// Delivery Time
if (isset($_POST['delivery']))
{
    $delivery = trim($_POST['delivery']);
}
else
{
    $delivery = 3;                      // Default value
}

switch ($delivery)
{
    case 1:
    case 2:
    case 3:
    case 4:
        // OK

        break;

    default:
        $isNoError = false;
        $errorMessage[] = 'Delivery Time value is wrong.';

        break;
}


////////////////////////////////////////////////////////////
// Html

echo '<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assignment3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/assignment3.css" /> 
       
</head>
<body>
<div class="form-header">    
    <h2>My Shop\'s Invoice</h2>
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
    // Calculate & Get Value
    // Province Name
    $provinceName = getProvinceName($province);

    // Product 1
    if (is_numeric($product1))
    {
        $quantityPriceProduct1 = $product1 * $UNIT_PRICE_PRODUCT1;
    }
    else
    {
        $quantityPriceProduct1 = 0;
    }    

    // Product 2
    if (is_numeric($product2))
    {
        $quantityPriceProduct2 = $product2 * $UNIT_PRICE_PRODUCT2;
    }
    else
    {
        $quantityPriceProduct2 = 0;
    } 

    // Product 3
    if (is_numeric($product3))
    {
        $quantityPriceProduct3 = $product3 * $UNIT_PRICE_PRODUCT3;
    }
    else
    {
        $quantityPriceProduct3 = 0;
    } 

    // Shipping Charge (Delevery Fee)
    $deliveryFee = calDeliveryFee($delivery);
    
    // Sub Total
    $subTotal = $quantityPriceProduct1 + $quantityPriceProduct2
            + $quantityPriceProduct3 + $deliveryFee;

    // Tax Rate
    $taxRate = getTaxRate($province);
    $taxRatePercent = $taxRate * 100;

    // Tax Price
    $taxPrice = round(($subTotal * $taxRate), 2);

    // Total
    $totalPrice = round(($subTotal + $taxPrice), 2);


    // Display Invoice
    echo "
        <table id='mytable' style='width:100%;'>
            <tr>
                <td align='left' width='60%'>NAME</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$name</td>
            </tr>
            <tr>
                <td align='left' width='60%'>EMAIL</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$email</td>
            </tr>
            <tr>
                <td align='left' width='60%'>PHONE</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$phone</td>
            </tr>
            <tr>
                <td align='left' width='60%'>DELIVERTY ADDRESS</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>
                    $address1,<br />
                    $city,<br />
                    $provinceName, $postalcode
                </td>
            </tr>
        ";

    if ($product1 > 0)    
    {
        echo "
            <tr>
                <td align='left' width='60%'>" . $product1 . " PRODUCT 1 @ $" . number_format($UNIT_PRICE_PRODUCT1, 2) . "</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$" . number_format($quantityPriceProduct1) . "</td>
            </tr>
        ";            
    }

    if ($product2 > 0)    
    {
        echo "
            <tr>
                <td align='left' width='60%'>" . $product2 . " PRODUCT 2 @ $" . number_format($UNIT_PRICE_PRODUCT2, 2) . "</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$" . number_format($quantityPriceProduct2) . "</td>
            </tr>
        ";             
    }

    if ($product3 > 0)    
    {
        echo "
            <tr>
                <td align='left' width='60%'>" . $product3 . " PRODUCT 3 @ $" . number_format($UNIT_PRICE_PRODUCT3, 2) . "</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$" . number_format($quantityPriceProduct3) . "</td>
            </tr>
        ";             
    }

    echo "
            <tr>
                <td align='left' width='60%'>SHIPPING CHARGES</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$" . number_format($deliveryFee) . "</td>
            </tr>
            <tr>
                <td align='left' width='60%'>SUB TOTAL</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$" . number_format($subTotal) . "</td>
            </tr>
            <tr>
                <td align='left' width='60%'>TAXES @ " . $taxRatePercent . "%</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$" . number_format($taxPrice, 2) . "</td>
            </tr>
            <tr>
                <td align='left' width='60%'>TOTAL</td>
                <td width='10%'>:</td>
                <td width='30%' align='right'>$" . number_format($totalPrice, 2) . "</td>
            </tr>    
        </table>
    ";
}

echo "
    </div>
</body>
</html>
"
?>