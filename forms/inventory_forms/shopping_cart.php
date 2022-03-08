<?php

//connect to database
include_once('../connect_mysql.php');

if(isset($_POST['submit']))
{
   
    $query ="SELECT * FROM cart_item WHERE SCID = '$SCID'";
    $query2 = "SELECT * FROM shopping_cart WHERE SCID = SCID";
    
}


?>