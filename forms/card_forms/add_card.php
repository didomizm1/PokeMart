<!DOCTYPE html>
<html>
    <body style="background-image: radial-gradient(circle, rgb(195, 235, 242) 40%, rgb(0, 180, 245) 180%);" >
<center>
    <br>
     <!-- Try to add on click method for card-->
  <h2> <font face="Arial" size="4px"> NEW PAYMENT METHOD </font> </h2> 
    <br>
  <form action ="/card_info.php">
        <label> Cardholder Name: 
            <input type = "text" name  = "full_name" maxlength = "50" autocomplete required />
        </label>
        <br><br>
        <label> Card Number: 
            <input type = "number" name  = "card_number" length="16" pattern = "0-9" autocomplete required />
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
        <label> Year: 
            <select name = "year">
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
        </label>
        <br><br>
        <label> cvv: 
            <input type = "number" name  = "cvv" minimulength = "3" maxlength="4" pattern = "0-9" autocomplete required />
        </label>
        <br><br>
    <h3> <font size="3px" >Billing Address </font> </h3>
        <label> Street Address 1:
            <input type = "text" name  = "street_1" maxlength = "100" autocomplete required />
        </label>  
        <br><br>
        <label> Street Address 2: 
            <input type = "text" name  = "street_2" maxlength = "100" autocomplete />
        </label>
        <br><br>
        <label> City:
            <input type = "text" name  = "city" maxlength = "100" autocomplete required />
        </label>  
        <br><br>
         <label> Zip Code: 
            <input type = "text" name  = "zip_code" minlength = "5" maxlength = "10" pattern = "^[A-Z\d]" autocomplete required />
        </label> 
        <br><br>
        <input type="checkbox" id="save_card" name="save_card">
             <label for="save_card"> Save Card </label>
            <br><br>
            <div>
                 <a href="http://localhost:8080/PokeKart/forms/card_forms/cont.php" >
                    <button>Use This Payment Method</button>
                </a>
             </div>
</center>
</body>
</html>