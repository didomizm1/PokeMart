<?php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //prepare login data
    $query1 = "INSERT INTO `user_login` (`username`, `password`)
    VALUES ('".$_POST['username']."','".$_POST['password']."')";

    //prepare user profile data
    $query2 = "INSERT INTO `user_profile` (`ULID`,`user_role_type`,`first_name`, `middle_name`, `last_name`, `gender`, `date_of_birth`, `email`, `home_phone_number`, `cell_phone_number`, `street_1`, `street_2`, `city`, `state`, `zip_code`, `country`)
    VALUES ((SELECT `ULID` FROM `user_login` WHERE `username` = '".$_POST['username']."'),'0','".$_POST['first_name']."','".$_POST['middle_name']."','".$_POST['last_name']."','".$_POST['gender']."','".$_POST['date_of_birth']."','".$_POST['email']."','".$_POST['home_phone_number']."',
     '".$_POST['cell_phone_number']."','".$_POST['street_1']."','".$_POST['street_2']."','".$_POST['city']."','".$_POST['state']."','".$_POST['zip_code']."','".$_POST['country']."')";

    //execute queries
    mysqli_query($dbconn, $query1) or die("Couldn't execute login data query\n");
    mysqli_query($dbconn, $query2) or die("Couldn't execute profile data query\n");
    
}

?>