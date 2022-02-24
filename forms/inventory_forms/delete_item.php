<?php
//detele_item.php

if(isset($_POST['submit']))
{
    include_once('connect_mysql.php');

    $item_name = $_POST['item_name'];
    $IID = $_POST['IID'];

     //setup query, insert item into inventory database
    if(isset($_POST['item_name']))
    {
        $query = "DELETE FROM pokemart_db WHERE pokemart_inventory = $item_name";
        
    }
    if(isset($_POST['IID']))
    {
        $query = "DELETE FROM pokemart_db WHERE pokemart_inventory = $IID";
        
    }

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