<?php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //check if username already exists
    $query0 = "SELECT `username` FROM `user_login` WHERE `username` = '".$_POST['username']."'";

    $result = mysqli_query($dbconn, $query0);
    if(mysqli_num_rows($result))
    {
        echo "<script> alert('Username already exists'); window.history.go(-1); </script>";
        exit();
    }

    //prepare login data
    $query1 = "INSERT INTO `user_login` (`username`, `password`) VALUES ('".$_POST['username']."','".password_hash($_POST['password'], PASSWORD_DEFAULT)."')";
    mysqli_query($dbconn, $query1) or die("Couldn't execute login data query\n");

    //get ULID in a variable
    $ULIDquery = "SELECT `ULID` FROM `user_login` WHERE `username` = '".$_POST['username']."'";
    $ULIDresult = mysqli_query($dbconn, $ULIDquery) or die("Couldn't execute login data query\n");
    $row1 = $ULIDresult->fetch_array(MYSQLI_ASSOC);
    $ULID = $row1['ULID'];

    //prepare user profile data
    $query2 = "INSERT INTO `user_profile` (`ULID`,`user_role_type`,`first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `email`, `home_phone_number`, `cell_phone_number`, `street_1`, `street_2`, `city`, `state`, `zip_code`, `country`)
    VALUES ('$ULID','0','".$_POST['first_name']."','".$_POST['middle_name']."','".$_POST['last_name']."','".$_POST['gender']."','".$_POST['date_of_birth']."','".$_POST['email']."','".$_POST['home_phone_number']."',
     '".$_POST['cell_phone_number']."','".$_POST['street_1']."','".$_POST['street_2']."','".$_POST['city']."','".$_POST['state']."','".$_POST['zip_code']."','".$_POST['country']."')";

    mysqli_query($dbconn, $query2) or die("Couldn't execute profile data query\n");

    //get UPID in a variable
    $UPIDquery = "SELECT `UPID` FROM `user_profile` WHERE `ULID` = '$ULID'";
    $UPIDresult = mysqli_query($dbconn, $UPIDquery) or die("Couldn't execute login data query\n");
    $row2 = $UPIDresult->fetch_array(MYSQLI_ASSOC);
    $UPID = $row2['UPID'];

    //prepare customer profile data
    $query3 = "INSERT INTO `customer_profile` (`UPID`, `card_count`, `number_of_purchases`, `total_money_spent`, `active_orders`)
    VALUES ('$UPID','0','0','0','0')";

    mysqli_query($dbconn, $query3) or die("Couldn't execute profile data query\n");

    //prepare new user's shopping cart
    $query4 = "INSERT INTO `shopping_cart` (`CPID`, `number_of_items`, `total_price`)
    VALUES ((SELECT `CPID` FROM `customer_profile` WHERE `UPID` = '$UPID'),'0','0')";

    mysqli_query($dbconn, $query4) or die("Couldn't execute profile data query\n");
    
    //send user to the login page
    header("Location: ../login_forms/login.html");
}

?>