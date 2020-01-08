<!--
    PROG1800-Dynamic Web Programming
    Heuijin Ko(8187452)
    Assignment 4
    The web form collect the information about new Vendor

    Revision Hostory:
        Heuijin Ko, 2019.04.07: Created
-->

<?php
    include("model.php");
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
    <script src="scripts/vendors.js"></script>
</head>
<body>
<div class="form-header">    
    <h2>VENDORS</h2>
    <section class="explain">
        <h5 class="text-explain">- The form should collect the information required <br />
        to insert a new vendor into the VENDORS table.</h5>
    </section>
</div>     
<div class="container">      
    <form id="myForm" name="myForm" method="POST" action="vendors.php">
        <!-- Vendor Number block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Vendor Number </label><span class="indicator">*</span> :
                <input type="text" class="form-control disable-input" id="vendorNumber2" name="vendorNumber2" value="<?php getVendorNo(); ?>" tabindex="1" disabled />   
                <input type="hidden" id="vendorNumber" name="vendorNumber" value="<?php getVendorNo(); ?>" />
            </div>
            <div class="form-error width45">
                <div id="vendorNumber_error" class="errMsg" style="display:none">Vendor Number</div>
            </div> 
        </div>
        <!-- Vendor Number block end -->

        <!-- Vendor Name block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Vendor Name </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="vendorName" name="vendorName" tabindex="2" onfocusout="isEmpty('vendorName');">
            </div>
            <div class="form-error width45">
                <div id="vendorName_error" class="errMsg" style="display:none">Plaeas enter the Vendor Name less than 30 letters.</div>
            </div> 
        </div>
        <!-- Vendor Name block end -->

        <!-- Address 1 block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Address 1 </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="address1" name="address1" tabindex="3" onfocusout="isEmpty('address1');">
            </div>
            <div class="form-error width45">
                <div id="address1_error" class="errMsg" style="display:none">Plaeas enter the Address 1 less than 30 letters.</div>
            </div> 
        </div>
        <!-- Address 1 block end -->

        <!-- Address 2 block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Address 2 </label>
                <input type="text" class="form-control" id="address2" name="address2" tabindex="4" />
            </div>
            <div class="form-error width45">
                <div id="address2_error" class="errMsg" style="display:none">Plaeas enter the Address 2 less than 30 letters.</div>
            </div> 
        </div>
        <!-- Address 2 block end -->

        <!-- City block start -->
        <div class="row">
            <div class="form-group width45">
                <label>City </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="city" name="city" tabindex="5" onfocusout="isEmpty('city');">
            </div>
            <div class="form-error width45">
                <div id="city_error" class="errMsg" style="display:none">Plaeas enter the City less than 20 letters.</div>
            </div> 
        </div>
        <!-- City block end -->

        <!-- Province block start -->
        <div class="row"> 
            <div class="form-group width45">
                <div class="style-select">                    
                    <label>Province </label><span class="indicator">*</span> :
                    <select id="province" name="province"  onchange="changeProvince()" tabindex="5" onforminput="isEmpty('province');">
                        <option value="">Select</option>
                        <?php
                            getProvince();
                        ?>
                    </select>
                </div>
            </div>  
            <div class="form-error width45">
                <div id="province_error" class="errMsg" style="display:none">Please select a Province.</div>
            </div>  
        </div> 
        <!-- Province block end -->

        <!-- Post Code block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Post Code </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="postCode" name="postCode" tabindex="7" onfocusout="isAvaliablePC();">
            </div>
            <div class="form-error width45">
                <div id="postCode_error" class="errMsg" style="display:none">Plaeas enter the Post Code. ex)A1B2C3</div>
            </div> 
        </div>
        <!-- Post Code block end -->

        <!-- Country block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Country Code</label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="country" name="country" tabindex="8" onfocusout="isAvaliableCountryCode();">
            </div>
            <div class="form-error width45">
                <div id="country_error" class="errMsg" style="display:none">Plaeas enter the Country with 2 letters ex)CA.</div>
            </div> 
        </div>
        <!-- Country block end -->

        <!-- Phone block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Phone </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="phone" name="phone" tabindex="9" onfocusout="phoneValidate();">
            </div>
            <div class="form-error width45">
                <div id="phone_error" class="errMsg" style="display:none">Plaeas enter the Phone (123-456-7890).</div>
            </div> 
        </div>
        <!-- Phone block end -->

        <!-- Fax block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Fax </label> :
                <input type="text" class="form-control" id="fax" name="fax" tabindex="10" />
            </div>
            <div class="form-error width45">
                <div id="fax_error" class="errMsg" style="display:none">Plaeas enter the Fax (123-456-7890).</div>
            </div> 
        </div>
        <!-- Fax block end -->
        <div class="row">
            <div class="form-item">
                <input type="button" class="submit" value="SUBMIT" tabindex="11"  onclick="validateVendor();" />
            </div>
        </div>    
        <!-- submit block end -->	
    </form>
</div>
<script type="text/javascript">
// onload function
window.onload = function()
{
    document.getElementById("vendorName").focus();
}
</script>
</body>
</html>