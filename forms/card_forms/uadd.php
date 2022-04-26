<?php
//session handling
require_once('../session.php');

    if(isset($_POST['submit']))
    {
        //connect w/data base 
        include_once('../connect_mysql.php');

        //get address form user_profile

    //    $UPID=$_SESSION['UPID'];
        $query = "INSERT INTO `card_info` 'street_1' 'stree_2' 'city' 'state' 'zip_code' VALUES  `stree_1`='".$_POST['stree_1']."',`stree_2`='".$_POST['stree_1']."',`city`='".$_POST['city']."', `state`='".$_POST['state']."',`zip_code`='".$_POST['zip_code']."'";
        mysqli_query($dbconn, $query) or die("Could not get address\n");
    
    }

    header("Location: add_card.php");
?>