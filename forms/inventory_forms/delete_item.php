<?php
//delete_item.php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    $item_name=$_POST['item_name'];
    $IID=$_POST['IID'];

    //add query
    $query="DELETE FROM inventory WHERE item_name = '$item_name' AND IID = '$IID'";

    //execute queries
    // mysqli_query($dbconn, $query) or die("Couldn't execute login data query\n");
    
    if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Item deleted successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>