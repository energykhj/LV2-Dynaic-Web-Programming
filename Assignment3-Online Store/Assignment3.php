<!--
    PROG1800-Dynamic Web Programming
    Heuijin Ko(8187452)
    Assignment 3
    Validate input fields and express as regular patterns.

    Revision Hostory:
        Heuijin Ko, 2019.03.22: Created
-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Assignment3</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="styles/assignment3.css" />
    <script src="scripts/assignment3.js"></script>
</head>
<body>
<div class="form-header">    
    <h2>Assignment 3</h2>
</div>     
<div class="container">  
    <form id="myForm" name="myForm" method="POST" action="functions.php">
        <!-- Name block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Name </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="name" name="name" tabindex="1" onfocusout="isEmpty('name');" autofocus />             
            </div>
            <div class="form-error width45">
                <div id="name_error" class="errMsg" style="display:none">Please enter your name.</div>
            </div> 
        </div>
        <!-- Name block end -->
        <div class="row">
        <!-- email block start -->
            <div class="form-group  width45">
                <label>Email Address </label><span class="indicator">*</span> :
                <input type="email" class="form-control" name="email" id="email" tabindex="2" onfocusout="isValidEmail('email');"/>                              
            </div>  
            <div class="form-error width45">
                <div id="email_error" class="errMsg" style="display:none">Please enter a valid email address using the format "test@example.ca".</div>
            </div>
        </div>        
        <!-- email block end -->
        <!-- phone block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Phone Number </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="phone" name="phone" tabindex="3" onkeypress='return ((event.charCode >= 48 && event.charCode <= 57) || event.keyCode == 45)' onfocusout="phoneValidate('phone');" placeholder="555-555-5555">
            </div>  
            <div class="form-error width45">
                <div id="phone_error" class="errMsg" style="display:none">Please enter a valid phone number using format 555-555-5555.</div>
            </div>
        </div>
        <!-- phone block end -->
        <!-- address block start -->
        <div class="row">
            <div class="form-group width45">
                <label>Address <span class="indicator">*</span></label> :
                <input type="text" class="form-control" id="address1" name="address1" tabindex="4" onfocusout="isEmpty('address1');" placeholder="" />
            </div>  
            <div class="form-error width45">
                <div id="address1_error" class="errMsg" style="display:none">Please enter a address.</div>
            </div>
        </div>   
        <!-- address block end -->
        <!-- city block start -->
        <div class="row">        
            <div class="form-group width45">
                <label>City </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="city" name="city" tabindex="5" onfocusout="isEmpty('city');" />
            </div>  
            <div class="form-error width45">
                <div id="city_error" class="errMsg" style="display:none">Please enter a city name.</div>
            </div>            
        </div>
        <!-- city block end -->
        <div class="row">
        <!-- postal code block start -->
            <div class="form-group width45">
                <label>Postal Code </label><span class="indicator">*</span> :
                <input type="text" class="form-control" id="postalcode" name="postalcode" tabindex="6" 
                    onfocusout="isAvaliablePC('postalcode');" placeholder="A0A 0A0" />
            </div>  
            <div class="form-error width45">
                <div id="postalcode_error" class="errMsg" style="display:none">Please enter a valid Postal code using the format "A0A 0A0".</div>
            </div>
        </div> 
        <!-- city block end -->
        <!-- province block start -->
        <div class="row"> 
            <div class="form-group width45">
                <div class="style-select">                    
                    <label>Province </label><span class="indicator">*</span> :
                    <select id="province" name="province" onchange="changeProvince()" tabindex="7" onforminput="isEmpty('province');">
                        <option value="">Select</option>
                        <option value="AB">Alberta</option>
                        <option value="BC">British Columbia</option>
                        <option value="MB">Manitoba</option>
                        <option value="NB">New Brunswick</option>
                        <option value="NL">Newfoundland and Labrador</option>
                        <option value="NT">Northwest Territories</option>
                        <option value="NS">Nova Scotia</option>
                        <option value="NU">Nunavut</option>
                        <option value="ON">Ontario</option>
                        <option value="PE">Prince Edward Island</option>
                        <option value="QC">Quebec</option>
                        <option value="SK">Saskatchewan</option>
                        <option value="YT">Yukon</option>
                    </select>
                </div>
            </div>  
            <div class="form-error width45">
                <div id="province_error" class="errMsg" style="display:none">Please select a province name.</div>
            </div>  
        </div>     
        <!-- province block end -->   
        <!-- Product block start -->
        <div class="row">        
            <div class="form-group width45">
                <label class="product_label">PRODUCT 1 : </label>
                <input type="text" class="form-control" id="product1" name="product1" tabindex="8" 
                    onfocusout="validateProduct('product1');"/>
            </div>  
            <div class="form-error width45">
                <div id="product1_error" class="errMsg" style="display:none">Only allow the positive numbers.</div>
            </div>            
        </div>
        <div class="row">        
            <div class="form-group width45">
                <label class="product_label">PRODUCT 2 : </label>
                <input type="text" class="form-control" id="product2" name="product2" tabindex="9" 
                    onfocusout="validateProduct('product2');"/>
            </div>  
            <div class="form-error width45">
                <div id="product2_error" class="errMsg" style="display:none">Only allow the positive numbers.</div>
            </div>            
        </div>
        <div class="row">        
            <div class="form-group width45">
                <label class="product_label">PRODUCT 3 : </label>
                <input type="text" class="form-control" id="product3" name="product3" tabindex="10" 
                    onfocusout="validateProduct('product3');"/>
            </div>  
            <div class="form-error width45">
                <div id="product3_error" class="errMsg" style="display:none">Only allow the positive numbers.</div>
                <div id="product_error" class="errMsg" style="display:none">You must buy one of the products.</div>
            </div>            
        </div>
        <!-- Product block end -->
        <!-- Delivery block start -->
        <div class="row"> 
            <div class="form-group width45">
                <div class="style-select">
                <label>Delivery Time :</label>
                    <select id="delivery" name="delivery" tabindex="11" onforminput="isEmpty('delivery');">
                        <option value="1">Next day</option>
                        <option value="2">2 DAYS</option>
                        <option value="3" selected>3 DAYS</option>
                        <option value="4">4 DAYS</option>
                    </select>
                </div>
            </div>  
            <div class="form-error width45">
                <div id="delivery_error" class="errMsg" style="display:none">Please select a delivery day(s).</div>
            </div>  
        </div>     
        <!-- Delivery block end -->        

        <!-- submit block start -->
        <hr class="reduced-margin">
        <div class="row">
            <div class="form-item">
                <!--input type="submit" class="submit btn-row" value="submit" onclick="submitValidation();" /-->
                <input type="button" class="submit" value="Place Order" onclick="submitValidation();" />
            </div>
        </div>    
        <!-- submit block end -->	
    </form>
</div>
</body>
</html>