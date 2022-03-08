<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$query = "SELECT * FROM `user_profile` WHERE `ULID` = '".$_SESSION['ULID']."'";
$result = mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
$row = $result->fetch_array(MYSQLI_ASSOC);


if(isset($_POST['submit']))
{
   
    $query2 ="SELECT * FROM cart_item WHERE SCID = '$SCID'";
    //$query2 = "SELECT * FROM shopping_cart WHERE SCID = SCID";
    
}


?>