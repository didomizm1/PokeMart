<?php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //prepare to fetch login data
    $query = "SELECT `username`, `password` FROM `user_login`  
    WHERE `username` = '".$_POST['username']."'";
    
    //store results and place into associative array
    $result = mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
    $row = $result->fetch_array(MYSQLI_ASSOC);

    //verify password and rehash if necessary
    if($row != null)
    {
        $inputPassword = $_POST['password'];
        $storedPassword = $row['password'];

        if(password_verify($inputPassword, $storedPassword))
        {
            if(password_needs_rehash($storedPassword, PASSWORD_DEFAULT))
            {
                $newHashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
            }
            echo nl2br("Login successful\n");
            //header("Location: homepage.html");
        }
        else
        {
            //sends the user back to the previous page to re-enter password
            echo "<script> alert('Incorrect password entered'); window.history.go(-1); </script>";
            exit();
        }
    }
    else
    {
        //sends the user back to the previous page to re-enter username
        echo "<script> alert('Username does not exist'); window.history.go(-1); </script>";
        exit();
    }

}

?>