<?php
//session handling
    require_once('../session.php');
?>    
 <!DOCTYPE html>
<html>
    <body>
    <link rel = "stylesheet" href = "add_card.css">

        <a href = "../home_page/index.php">
         <img id="logo" SRC="../../img/lnt/logo.png">
        </a>
<center>
<fieldset id = cards >
     <!-- Try to add on click method for card-->
  <h2> <font face="Arial" size="5px"> NEW PAYMENT METHOD </font> </h2> 
  <div id = "form">  
  <form id="form" action="acard.php" method="POST">
  <p><strong><em><font size="2px">(Fields identified with * are required)</font></em></strong></p>
        <label> Card Holder Name: *
            <input  type = "text" name  = "card_holder_name" maxlength = "50" autocomplete required />
        </label>
        <br><br>
        <label> Card Number: *
            <input style="text-align: center" type = "number" name  = "card_number" length="16" pattern = "0-9" autocomplete required />
        </label>
        <br><br>
        <label> Month: *
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
         Year: * <select name = "year">
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
         cvv:  *<input type = "number" name  = "cvv" minimulength = "3" maxlength="4" pattern = "0-9" autocomplete required />
        <br><br>

<input type="checkbox" id="myCheck" onclick="myFunction()"> Billing Address is different from Saved Address
	<script src = "addaddress.js"></script>   

<p id="text" style="display:none">Billing Address Information 
<br><br>
     Street Address 1: *
            <input type = "text" name  = "street_add_1" maxlength = "100" autocomplete required />
       
        <br><br>
        Street Address 2: 
            <input type = "text" name  = "street_add_2" maxlength = "100" autocomplete />
       
        <br><br>
        City: *
            <input type = "text" name  = "city" maxlength = "100" autocomplete required />
         
        <br><br>
          Zip Code: *
            <input type = "text" name  = "zip_code" minlength = "5" maxlength = "10" pattern = "^[A-Z\d]+$" autocomplete required />
       
        <br><br>
    </p>
    <br>
         <div>        
                <font face="Arial" size ="3px">    
                    <a href="../card_forms/uadd.php"> </a>
                </font> 
        </div>
        <form id="form" action="acard.php" method="POST">
            <input type="submit" name="submit" id="save card" hidden/>
        </form>
        <form id="form" action="uadd.php" method="POST">
            <input type="submit" name="submit" id="save card" hidden/>
        </form>
        <a href = "wallet.php">
        <input type="submit" name="submit" id="save card"/>
        </a>

</div>
</form>
</center>
</fieldset>
</body>
</html>