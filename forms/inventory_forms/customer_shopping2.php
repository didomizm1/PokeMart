<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
//require_once('../session.php');

if(isset($_POST['submit']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `inventory` WHERE CONCAT(`IID`, `item_name`, `japanese_item_name`, `selling_price`) LIKE '%".$valueToSearch."%'";
    $result = mysqli_query($dbconn, $query);
    
}
else 
{
    $query = "SELECT * FROM `inventory`";
    $result = mysqli_query($dbconn, $query);
}

?>