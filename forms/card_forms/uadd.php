<?php

    //session handling
    require_once('../session.php');

    if(isset($_POST['submit']))
    {
        //connect w/data base 
        include_once('../connect_mysql.php');

        //get address form user_profile
        $UADDRESS = "SELECT 'street_1' 'stree_2' 'city' 'state' 'zip_code' FROM `user_profile` WHERE `stree_1`='".$_POST['stree_1']."',`stree_2`='".$_POST['stree_1']."',`city`='".$_POST['city']."', `state`='".$_POST['state']."',`zip_code`='".$_POST['zip_code']."'";

        mysqli_query($dbconn, $$UADDRESS) or die("Could not get address\n");
    
    }

    header("Location: add_card.php");
?>

<!DOCTYPE html>
<html>
<body>
        <style>
            body{
            background-image:url('../../img/card/bkgd.jpg');
            background-size:cover;
            } 
            input[type=checkbox] {
            border: none;
            border-radius:50px;
            text-decoration: none;
            margin-left: 1%;
            cursor: pointer;
            }
        </style>
        <a href = "../home_page/index.php">
         <IMG id="logo" SRC="../../img/lnt/logo.png"
         width="300"
         height="100">
        </a>
        <form id="form" action="uadd.php" method="POST">

        <h3> <font size="4px" >Billing Address </font> </h3>
        <label> Street Address 1:
            <input type = "text" name  = "street_add_1" maxlength = "100" autocomplete required />
        </label>  
        <br><br>
        <label> Street Address 2: 
            <input type = "text" name  = "street_add_2" maxlength = "100" autocomplete />
        </label>
        <br><br>
        <label> City:
            <input type = "text" name  = "city" maxlength = "100" autocomplete required />
        </label>  
        <br><br>
         <label> Zip Code: 
            <input type = "text" name  = "zip_code" minlength = "5" maxlength = "10" pattern = "^[A-Z\d]+$" autocomplete required />
        </label> 
        <br><br>
      
        <input type="checkbox" name="check" id="submit" value="1" checked> save card 
            <br><br> 
        <label>
            <input type="submit" id="submit" name="submit" value = "Use this payment method"/>
        </label>
     </form>
</body>    
</html>
