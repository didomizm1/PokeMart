<?php

//DO NOT MODIFY THIS FILE, THIS IS A SAMPLE TEMPLATE TO BE COPIED AND USED FOR YOUR OWN FORMS
if(isset($_POST['submit']))
{
    //this statement refers to the connect file in a parent directory relative to your php file
    include_once('../connect_mysql.php');


    
    //setup query (CHANGE THIS FOR YOUR QUERY)
    $query = "INSERT INTO `pokemart_inventory` (`item_name`, `japanese_item_name`, `item_description`, `item_type`, `product_id`, `selling_price`, `cost`, `in_stock`, `reorder_amount`, `base_stock`)
    VALUES ('".$_POST['item_name']."','".$_POST['japanese_item_name']."','".$_POST['item_description']."','".$_POST['item_type']."',
     '".$_POST['product_id']."','".$_POST['selling_price']."','".$_POST['cost']."','".$_POST['in_stock']."','".$_POST['reorder_amount']."','".$_POST['base_stock']."')";


    if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Query successful\n");
        //^^^CHANGE THAT TEXT TO BE MORE RELEVANT TO YOUR QUERY
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }

    //store results in a variable
    //$result = mysqli_query($dbconn, $query) or die("Couldn't execute query\n");

    //convert result to an associative array
    //$row = $result->fetch_array(MYSQLI_ASSOC);
}

?>