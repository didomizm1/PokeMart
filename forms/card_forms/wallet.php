<?php
    //session handling
    require_once('../session.php');
?>

<!DOCTYPE html>
<html>  
<body>
    <style>
        body
        {
            background-image:url('../../img/card/bkgd.jpg');
            background-size:cover;
        } 
    </style>
    <a href = "../home_page/index.php">
        <IMG id="logo" SRC="../../img/lnt/logo.png" width="300" height="100">
    </a>
    <br><br>
    <center>     
        <IMG SRC="../../img/card/My-Wallet.png" width="300" height="100">

        <br><br>
        <label> 
            <div>
                <IMG SRC="../../img/card/Saved-Payments.png" >
                <br><br> 
            </div>
        </label>

        <form id="form" action="search_card.php" method="POST">
            <input type="submit" name="submit" />
        </form>

        <br><br>
        <label> 
            <div>
                <font face="Arial" size ="3px">    
                    <a href="../card_forms/add_card.php"> Add New Payment </a>
                </font> 
            </div>
            <br>
            <div>
                <a href="../card_forms/cont.html" >
                    <button>Use This Payment Method</button>
                </a>
            </div>
        </label>
    </center>
</body>
</html>