<?php

//connect to database
include_once('../connect_mysql.php');

if(isset($_POST['submit']))
{
    $query = "SELECT * FROM `shopping_cart`";
    $search_result = filterTable($query);
    
}
 else 
 {
    $query = "SELECT * FROM `shopping_cart`";
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