<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];


if(isset($_POST['submit']))
{
    $query ="SELECT * FROM cart_item WHERE SCID = '$SCID'";
    $result = mysqli_query($dbconn, $query);
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $IID = $row['IID'];
        $query2 = "SELECT * FROM inventory WHERE IID = '$IID'";
        $search_result = mysqli_query($dbconn, $query2);
        $row2 = $search_result->fetch_array(MYSQLI_ASSOC);
    }
}
?>