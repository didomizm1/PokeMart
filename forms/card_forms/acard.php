<?php

    //session handling
    require_once('../session.php');

    //add card
    if(isset($_POST['submit']))
    {
        //connect w/data base 
        include_once('../connect_mysql.php');

        //save to database
        $query = "INSERT INTO `card_info` (`CPID`, `card_holder_name`, `card_number`, `cvv`, `month`, `year`,`street_add_1`,`street_add_2`,`city`,`zip_code`) VALUES ('".$_SESSION['CPID']."','".$_POST['card_holder_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['year']."','".$_POST['street_add_1']."','".$_POST['street_add_2']."','".$_POST['city']."','".$_POST['zip_code']."')"; 
        mysqli_query($dbconn, $query) or die("Could not save card\n");
    }

    header("Location: wallet.php");
?>