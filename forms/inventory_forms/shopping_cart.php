<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];

if(isset($_POST['submit']))
{
   
    $query2 ="SELECT * FROM cart_item WHERE SCID = '$SCID'";
    
}


?>