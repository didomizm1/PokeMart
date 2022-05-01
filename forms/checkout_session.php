<?php
    //ensures a user can access checkout pages

    session_start();
    if(!(isset($_SESSION['canCheckout'])))
    {
        header('Location: ../home_page/index.php');
    }
?>
