<?php
//add_to_wishlight.php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];
$IID=$_POST['IID'];
$quantity=$_POST['quantity'];

if(isset($_POST['add']))
{
    //queries 
    $query1="INSERT INTO wishlist (IID) FROM inventory WHERE IID = '$IID'";
    $query2="INSERT INTO wishlist (SCID) FROM shopping_cart WHERE SCID = '$SCID'";
    $query3="INSERT INTO wishlit (quantity) VALUES ('$quantity)";

    //execute queries
    if($dbconn->query($query1 && $query2 && $query3)==TRUE)
    {
        echo nl2br("Item added to wishlist successfully\n");
    }
   
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>
