<?php
    //session handling
    require_once('../session.php');
?>

<!DOCTYPE html>
<html>
     <style>
            body{
            background-image:url('../../img/card/bkgd.jpg');
            background-size:cover;
            } 
            input[type=checkbox] {
            border: none;
            border-radius:50px;
            text-decoration: none;
            margin-left: 1%;
            cursor: pointer;
            }
        </style>
    <body>
       
        <a href = "../home_page/index.php">
         <IMG id="logo" SRC="../../img/lnt/logo.png"
         width="300"
         height="100">
        </a>
<center>
     <!-- Try to add on click method for card-->
  <h2> <font face="Arial" size="5px"> NEW PAYMENT METHOD </font> </h2> 
  <br>
  <form id="form" action="acard.php" method="POST">
        <label> Card Holder Name: 
            <input  type = "text" name  = "card_holder_name" maxlength = "50" required />
        </label>
        <br><br>
        <label> Card Number: 
            <input style="text-align: center" type = "number" name  = "card_number" length="16" pattern = "0-9" required />
        </label>
        <br><br>
        <label> Month: 
            <select name = "month">
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
            </select>
        </label>
            <br><br>
         Year:  <select name = "year">
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
                <option value="2030">2030</option>
                <option value="2031">2031</option>
                <option value="2032">2032</option>
                <option value="2033">2033</option>
            </select>    
        
        <br><br>
         cvv:  <input type = "number" name  = "cvv" minimulength = "3" maxlength="4" pattern = "0-9" autocomplete required />
        <br><br>
        <input type="checkbox" name="check" id="submit" value="1" checked> billing address is same as customer address
  </form>

     <font face="Arial" size ="3px">    
        <a href="../card_forms/uadd.php"> other billing address </a>
    </font>
</center>
</body>
</html>