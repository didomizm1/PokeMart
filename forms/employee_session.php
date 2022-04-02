<?php
    //this code should be used with require_once() in any page that is 
    //deemed to be private (protected by passwords), as well as should
    //only be accessed by employees

    session_start();
    if((!(isset($_SESSION['ULID']))) || (isset($_SESSION['ULID']) && !($_SESSION['user_role_type'] > 0)))
    {
        header('Location: ../home_page/index.php');
    }
?>
