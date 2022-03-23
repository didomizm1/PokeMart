<?php
//remove_from_cart.php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];
$IID=$_POST['IID'];
$quantity=$_POST['quantity'];

if(isset($_POST['submit']))
{
    //queries 
    $query1="DELETE FROM cart_item (IID) FROM inventory WHERE IID = '$IID'";
    $query2="DELETE FROM cart_item (SCID) FROM shopping_cart WHERE SCID = '$SCID'";
    $query3="DELETE FROM cart_item (quantity) VALUES ('$quantity)";

    //execute queries
    if($dbconn->query($query1 && $query2 && $query3)==TRUE)
    {
        echo nl2br("Item deleted from cart successfully\n");
    }
   
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>
