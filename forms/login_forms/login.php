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
        echo nl2br("Login data query successful\n");        
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
    
    $result = mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
    $row = $result->fetch_array(MYSQLI_ASSOC);

    if($row['password'] == $_POST['password'])
    {
        echo nl2br("Login successful\n");
    }
    else
    {
        echo nl2br("Login unsuccessful\n");
    }

}

?>