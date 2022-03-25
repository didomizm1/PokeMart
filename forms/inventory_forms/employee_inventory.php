<?php
//connect to database
include_once('../connect_mysql.php');

if(isset($_POST['submit']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `inventory` WHERE CONCAT(`IID`, `VID`, `item_name`, `japanese_item_name`, `item_description`, `item_type`, `selling_price`, `cost`, `in_stock`, `reorder_amount`, `base_stock`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
}
 else 
 {
    $query = "SELECT * FROM `inventory`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost","root","","pokemart_db");
    //$connect = include_once('connect_mysql.php');
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>