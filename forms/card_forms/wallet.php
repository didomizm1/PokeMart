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
        <IMG SRC="../../img/lnt/wallet.png" width="270" height="90">

        <br><br>
        <label> 
            <div>
                <IMG SRC="../../img/lnt/saved_payments.png" >
                <br><br> 
            </div>
        </label>
        <form id="form" action="search_card.php" method="POST">
            <input type="submit" name="submit" hidden/>

        </form>
        <br><br>
        <label> 
            <div>
                <font face="Arial" size ="3px">    
                    <a id = "add" href="../card_forms/add_card.php"> Add New Payment </a>
                </font> 
            </div>
            <br>
        </label>
    </center>
</body>
</html>