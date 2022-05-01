<?php
    //ensures that a user has not already logged in before accessing a page

    session_start();
    if(isset($_SESSION['ULID']))
    {
        header('Location: ../home_page/index.php');
    }
?>