<?php
//delete_item.php
//session handling
require_once('../employee_session.php');

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    $item_name=$_POST['item_name'];
    $IID=$_POST['IID'];

    //add query
    $query="DELETE FROM inventory WHERE item_name = '$item_name' AND IID = '$IID'";

    //execute queries
    mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
    header('Location: employee_inventory.php');
}

?>