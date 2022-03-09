<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$query1 = "SELECT UPID FROM user_profile WHERE ULID = '".$_SESSION['ULID']."'";
$result = mysqli_query($dbconn, $query1) or die("Couldn't execute query\n");
$row = $result->fetch_array(MYSQLI_ASSOC);

$query2 = "SELECT CPID FROM customer_profile WHERE UPID = '".$row['UPID']."'";
$result = mysqli_query($dbconn, $query2) or die("Couldn't execute query\n");
$row = $result->fetch_array(MYSQLI_ASSOC);

$query3 = "SELECT SCID FROM shopping_cart WHERE CPID = '".$row['CPID']."'";
$result = mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");
$row = $result->fetch_array(MYSQLI_ASSOC);



if(isset($_POST['submit']))
{
   
    $query2 ="SELECT * FROM cart_item WHERE SCID = '$SCID'";
    
}


?>