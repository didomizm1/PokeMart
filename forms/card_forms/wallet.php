<?php
    //session handling
    require_once('../session.php');
?>
<!DOCTYPE html>
<html>  
<body>
<link rel = "stylesheet" href = "wallet.css">

    <a href = "../home_page/index.php">
        <img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart"> 
    </a>
    <br><br>
    
    <center>     
        <img id = "wallet" src="../../img/lnt/wallet.png" width="270" height="90">
        <br><br>
        <label> 
            <div>
                <font face="Arial" size ="3px">    
                    <a id = "add" href="../card_forms/add_card.php"> Add New Payment </a>
                </font> 
            </div>
            <br>
        </label>
        <br><br>
        <label> 
            <div>
                <IMG id = "saved_payments" SRC="../../img/lnt/saved_payments.png" >
                <br><br> 
            </div>
        </label>
        <div id = "search">
            <?php
                include_once('search_card.php');
            ?>
        </div>
    </center>
</body>
</html>