<?php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //prepare to fetch login data
    $query = "SELECT `username`, `password` FROM `user_login`  
    WHERE `username` = '".$_POST['username']."'";
    
    
    //retrieve login data
    if($dbconn->query($query)==TRUE)
    {
        echo "Login data query successful";
    }
    else
    {
        echo "Error: " .$query ."<br>" .$dbconn->error;
    }
    
}

?>