<?php
//search_item.php

if(isset($_POST['submit']))
{
    include_once('connect_mysql.php');

    $item_name = $_POST['item_name'];

    //setup query
 
    //$query = "SELECT FROM inventory WHERE item_name = $item_name";


/*
    while($result = $mysqli -> query("SELECT * FROM inventory WHERE item_name LIKE '%$item_name%"));
    {
        echo 'Proudct ID'.$row['IID'];
        echo '<br/> Item: '.$row['item_name'];
        echo '<br/> Price: '.$row['selling_price'];
        echo '<br/><br/>';
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
*/
}
?>