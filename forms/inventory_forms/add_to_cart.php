<?php
//add_to_cart.php

if(isset($_POST['add']))
{
    //connect to database
    include_once('../connect_mysql.php');

    $IID=$_POST['IID'];

    //add query
    $query="INSERT INTO cart_item ('IID') FROM inventory WHERE 'IID' = $IID";

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
