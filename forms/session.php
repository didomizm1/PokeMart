<?php
    //this code should be used with require_once() in any page that is 
    //deemed to be private (protected by passwords)

    session_start();
    if(!(isset($_SESSION['ULID'])))
    {
        header('Location: ../home_page/index.php');
    }
?>
