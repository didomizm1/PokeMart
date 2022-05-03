<?php
//add_item.php
//session handling
require_once('../employee_session.php');

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //add query
    $query = "INSERT INTO `inventory` (`VID`,`item_name`, `japanese_item_name`, `item_description`, `item_type`, `selling_price`, `cost`, `in_stock`, `reorder_amount`, `base_stock`,`date_ordered`)
    VALUES ('".$_POST['VID']."','".$_POST['item_name']."','".$_POST['japanese_item_name']."','".$_POST['item_description']."','".$_POST['item_type']."'
    ,'".$_POST['selling_price']."','".$_POST['cost']."','".$_POST['in_stock']."','".$_POST['reorder_amount']."','".$_POST['base_stock']."','".$_POST['date_ordered']."')";

   //execute queries
   mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
   header('Location: employee_inventory.php');
}

?>