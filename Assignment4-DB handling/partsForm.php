<!--
    PROG1800-Dynamic Web Programming
    Heuijin Ko(8187452)
    Assignment 4
    The web form collect the information about new Part

    Revision Hostory:
        Heuijin Ko, 2019.04.01: Created
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
    <script src="scripts/parts.js"></script>
</head>
<body>
<div class="form-header">    
    <h2>PARTS</h2>
    <section class="explain">
        <h5 class="text-explain">- The form should collect the information required <br />
        to insert a new Part into the PARTS table.</h5>
    </section>
</div>     
<div class="container">  
    <form id="myForm" name="myForm" method="POST" action="parts.php">
        <!-- PartID block start -->
        <div class="row">
            <div class="form-group width45">
                <label>PartID </label><span class="indicator">*</span> :
                <input type="text" class="form-control disable-input" id="partid2" name="partid2" value="<?php getID(); ?>" disabled />   
                <input type="hidden" id="partid" name="partid" value="<?php getID(); ?>" />
            </div>
            <div class="form-error width45">
                <div id="partid_error" class="errMsg" style="display:none">Part ID.</div>
            </div> 
        </div>
        <!-- PartID block end -->

        <!-- VendorName block start -->
        <div class="row"> 
            <div class="form-group width45">
                <div class="style-select">                    
                    <label>Vendor Name </label><span class="indicator">*</span> :
                    <select id="vendorNo" name="vendorNo"  onchange="changeVendor()" tabindex="1" onforminput="isEmpty('vendorNo');">
                        <option value="">Select</option>
                        <?php
                            getVendor();
                        ?>
                    </select>
                </div>
            </div>  
            <div class="form-error width45">
                <div id="vendorNo_error" class="errMsg" style="display:none">Please select a vendor.</div>
            </div>  
        </div> 
        <!-- VendorName block end -->
        <!-- Description block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Description </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="description" name="description" tabindex="3" onfocusout="isEmpty('description');">
            </div>  
            <div class="form-error width45">
                <div id="description_error" class="errMsg" style="display:none">Please enter a Description less than 30 letters.</div>
            </div>
        </div>
        <!-- Description block end -->
        <!-- On Hand block start -->
        <div class="row">
            <div class="form-group width45">
                <label>On Hand <span class="indicator">*</span></label> :
                <input type="text" class="form-control" id="onhand" name="onhand" tabindex="4" onfocusout="isNumber('onhand');" placeholder="" />
            </div>  
            <div class="form-error width45">
                <div id="onhand_error" class="errMsg" style="display:none">Please enter a on hand quantities(only number).</div>
            </div>
        </div>   
        <!-- On Hand block end -->
        <!-- On Order block start -->
        <div class="row">        
            <div class="form-group width45">
                <label>On Order </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="onorder" name="onorder" tabindex="5" onfocusout="isNumber('onorder');" />
            </div>  
            <div class="form-error width45">
                <div id="onorder_error" class="errMsg" style="display:none">Please enter a order quantities(only positive number).</div>
            </div>            
        </div>
        <!-- On Order block end -->
        <div class="row">
        <!-- Cost block start -->
            <div class="form-group width45">
                <label>Cost </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="cost" name="cost" tabindex="6" onfocusout="isPositiveFloat('cost');" />
            </div>  
            <div class="form-error width45">
                <div id="cost_error" class="errMsg" style="display:none">Please enter a cost(only positive number).</div>
            </div>
        </div> 
        <!-- ciCostty block end -->
        <!-- Last Price block start -->
        <div class="row">        
            <div class="form-group width45">
                <label class="product_label">Last Price </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="price" name="price" tabindex="7" onfocusout="isValidatePrice('price');" />
            </div>  
            <div class="form-error width45">
                <div id="price_error" class="errMsg" style="display:none">Please enter a last price(only positive number).</div>
                <div id="price_c_error" class="errMsg" style="display:none">Our last price must be more than cost. </div>
            </div>            
        </div>
        <!-- Last Price block end -->
        <hr class="reduced-margin">
        <!-- submit block start -->
        <div class="row">
            <div class="form-item">
                <!--input type="submit" class="submit btn-row" value="submit" onclick="submitValidation();" /-->
                <input type="button" class="submit" value="SUBMIT" tabindex="8"  onclick="validatePart();" />
            </div>
        </div>    
        <!-- submit block end -->	
    </form>
</div>
<script type="text/javascript">
// onload function
window.onload = function()
{
    document.getElementById("vendorNo").focus();
}
</script>
</body>
</html>