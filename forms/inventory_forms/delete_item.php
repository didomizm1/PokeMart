<?php
//detele_item.php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //add query
    /*
    $query = "INSERT INTO `inventory` (`VID`,`item_name`, `japanese_item_name`, `item_description`, `item_type`, `selling_price`, `cost`, `in_stock`, `reorder_amount`, `base_stock`)
    VALUES ('".$_POST['VID']."','".$_POST['item_name']."','".$_POST['japanese_item_name']."','".$_POST['item_description']."','".$_POST['item_type']."'
    ,'".$_POST['selling_price']."','".$_POST['cost']."','".$_POST['in_stock']."','".$_POST['reorder_amount']."','".$_POST['base_stock']."')";
    */
    //execute queries
   // mysqli_query($dbconn, $query) or die("Couldn't execute login data query\n");
    
    if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Item added successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }

}
?>