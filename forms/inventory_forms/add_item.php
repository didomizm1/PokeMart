<?php
//add_item.php

if(isset($_POST['submit']))
{
    include_once('connect_mysql.php');

    //setup query, insert item into inventory database
    $query = "INSERT INTO `pokemart_inventory` (`item_name`, `japanese_item_name`, `item_description`, `item_type`, `product_id`, `selling_price`, `cost`, `in_stock`, `reorder_amount`, `base_stock`)
    VALUES ('".$_POST['item_name']."','".$_POST['japanese_item_name']."','".$_POST['item_description']."','".$_POST['item_type']."',
     '".$_POST['product_id']."','".$_POST['selling_price']."','".$_POST['cost']."','".$_POST['in_stock']."', '".$_POST['reorder_amount']."','".$_POST['base_stock']."')";

    if($dbconn->query($query)===TRUE)
    {
        echo "Item added successfully)";
    }
    else
    {
        echo "Error: " .$query ."<br>" .$dbconn->error;
    }

    //fetch results
    $result = mysqli_query($dbconn, $query) or die("Couldn't execute query");

}
?>