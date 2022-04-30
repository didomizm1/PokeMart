<?php

    //session handling
    require_once('../session.php');

    //connect w/ database 
    include_once('../connect_mysql.php');

    //add card
    if(isset($_POST['submit']))
    {
        $query;
        //set query depending upon whether a new address was entered or not
        if(isset($_POST['check'])) //use new address
        {
            $query = "INSERT INTO `card_info` (`CPID`, `card_holder_name`, `card_number`, `cvv`, `month`, `year`, `street_add_1`, `street_add_2`, `city`, `zip_code`) VALUES ('".$_SESSION['CPID']."','".$_POST['card_holder_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['year']."','".$_POST['street_add_1']."','".$_POST['street_add_2']."','".$_POST['city']."','".$_POST['zip_code']."')";
        }
        else //use user profile address
        {
            //get user's profile ID
            $UPID = $_SESSION['UPID'];

            //get address from user profile
            $userAddress = "SELECT `street_1`, `street_2`, `city`, `zip_code` FROM `user_profile` WHERE `UPID` = '$UPID'";
            $userAddressResult = mysqli_query($dbconn, $userAddress) or die("Could not get address\n");
            $userAddressRow = $userAddressResult->fetch_array(MYSQLI_ASSOC);

            $query = "INSERT INTO `card_info` (`CPID`, `card_holder_name`, `card_number`, `cvv`, `month`, `year`, `street_add_1`, `street_add_2`, `city`, `zip_code`) VALUES ('".$_SESSION['CPID']."','".$_POST['card_holder_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['year']."','".$userAddressRow['street_1']."','".$userAddressRow['street_2']."','".$userAddressRow['city']."','".$userAddressRow['zip_code']."')";
        }

        //save to database
        mysqli_query($dbconn, $query) or die("Could not save card\n");

    }

    header("Location: wallet.php");
?>