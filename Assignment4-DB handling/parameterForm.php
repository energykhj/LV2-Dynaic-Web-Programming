<!--
    PROG1800-Dynamic Web Programming
    Heuijin Ko(8187452)
    Assignment 4
    The web form query database

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
    <script src="scripts/parameter.js"></script>
</head>
<body>
<div class="form-header">    
    <h2>SEARCH</h2>
    <section class="explain">
        <h5 class="text-explain">- Select List (Search Type) and click 'SUBMIT' button.</h5>
    </section>
</div>     
<div class="container">  
    <form id="myForm" name="myForm" method="POST" action="parameter.php">
        
        <!-- Search Type block start -->
        <div class="row"> 
            <div class="form-group width45">
                <div class="style-select">                    
                    <label>List </label><span class="indicator">*</span> :
                    <select id="searchType" name="searchType" onchange="changeSearchType();">
                        <option value="">Select</option>
                        <?php
                            getSearchType();
                        ?>
                    </select>
                </div>
            </div>  
            <div class="form-error width45">
                <div id="searchType_error" class="errMsg" style="display:none">Please select a List (Search Type).</div>
            </div>  
        </div> 
        <!-- Search Type block end -->
        <div class="row">
            <div class="form-item">
                <input type="button" class="submit" value="SUBMIT" onclick="validateParameter();" />
            </div>
        </div>    
        <!-- submit block end -->	
    </form>
</div>
<script type="text/javascript">
// onload function
window.onload = function()
{
    document.getElementById("searchType").focus();
}
</script>
</body>
</html>