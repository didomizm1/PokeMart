<?php
    //Matthew DiDomizio

    //ends session, thus logging the user out, then sends user back to home page
    session_start();
    session_unset();
    session_destroy();
    
    header('Location: ../home_page/index.php');
?>