<!--
    PROG1800-Dynamic Web Programming
    Heuijin Ko(8187452)
    Assignment 4
    Database connection and query

    Revision Hostory:
        Heuijin Ko, 2019.04.03: Created
-->
 <?PHP
    require_once("functions.php");
    require_once("model.php");

    $search = "";
    $searchVal = "";

    if(!empty($_POST)){

      $search = (isset($_POST['search'])) ? $_POST['search'] : "";
      $searchVal = (isset($_POST['searchVal'])) ? $_POST['searchVal'] : "";
    }

    if(!empty($_GET)){

        $search = (isset($_GET['search'])) ? $_GET['search'] : "";
        $searchVal = (isset($_GET['searchVal'])) ? $_GET['searchVal'] : "";
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
    <script src="scripts/assignment4.js"></script>
</head>
<body>
<div class="form-header">    
    <h2>Assignment4</h2>
</div>     
<section class="explain">
  <h2 class="text-explain">- This form helps you to create(add) Part, Vendor and to retrieve  you want.</h2>
  <h2 class="text-explain">- Click the <font color="green"> green button</font>, Add Part, you can create a new part.</h2>
  <h2 class="text-explain">- Click the <font color="blue"> blue button</font>, Add Vendor, you can create a new vendor.</h2>
  <h2 class="text-explain">- Enter the string in the box if you want to search.</h2>
</section>
  <div class="container-main">  
    <form id="myForm" name="myForm" method="POST" action="mainForm.php">
      <div class="row">
        <div class="form-group">
            <!--input type="submit" class="submit btn-row" value="submit" onclick="submitValidation();" /-->
            <input type="button" class="button-vendor" value="Add Vendor" onclick="popupWin('vendor');" tabindex="1"/>
        </div>
        <div class="form-group">
            <input type="button" class="button-part" value="Add Part" onclick="popupWin('part');" tabindex="2" />
        </div>

        <div class="form-group style-select-main">                    
            <select id="search" name="search" onchange="changeSearchTag()" tabindex="3" onforminput="isEmpty('search');">
                <option value="everything">everything</option>
                <option value="vendors" <?php if($search == 'vendors') echo 'selected'; ?> >VendorName</option>
                <option value="parts" <?php if($search == 'parts') echo 'selected'; ?> >Description</option>
            </select>
        </div>

        <div class="form-group">
            <input type="text" class="form-control-35" id="searchVal" name="searchVal" value="<?php echo $searchVal ; ?>" tabindex="4"  /> 
        </div> 


        <div class="form-group">
            <input type="submit" class="button-search" value="Search" tabindex="5" />
        </div>        
      </div>  
        <!-- submit block end -->   
    </form>
  </div>
  <div class="container-result">  
    <div class="row">
      <?php
        $param["search"] = $search;
        $param["searchVal"] = $searchVal;

        echo SearchbyValue($param);
        
        /*
        if(!empty($_POST)){
            if (isset($_POST['search']))
            {   
                echo SearchbyValue($_POST);
            }
            if (isset($_GET['search']))
            {   
                echo SearchbyValue($_GET);
            }
        }
        */
      ?>

    </div>
  </div>
</body>
</html>