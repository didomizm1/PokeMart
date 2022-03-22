<?php
//add_to_cart.php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];

if(isset($_POST['add']))
{
   
    //add query
    $query="INSERT INTO cart_item (IID) FROM inventory WHERE IID = '$IID'";

    //execute queries
    if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Item added to cart successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>
