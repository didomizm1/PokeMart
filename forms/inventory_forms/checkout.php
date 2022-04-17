<?php

	//connect to database
	include_once('../connect_mysql.php');
	//session handling
	require_once('../session.php');

	//get shopping cart associated with logged in user
	$SCID = $_SESSION['SCID'];
	//get customer profile info associated with logged in user
	$CPID = $_SESSION['CPID'];

	//get credit card information if there is any
	//$query ="SELECT * FROM card_info WHERE CIID = '$CIID'";

	//verify credit card information is valid

	if(isset($_POST['submit']))
	{

		//check stock before allowing check out
		$canCheckout = true;

		$cartItemQuery = "SELECT IID, quantity FROM shopping_cart_item WHERE SCID = '$SCID'";
		$cartItemResult = mysqli_query($dbconn, $cartItemQuery) or die("Couldn't execute query\n");
		while($cartItemRow = $cartItemResult->fetch_array(MYSQLI_ASSOC))
		{
			$inventoryQuery = "SELECT item_name, in_stock FROM inventory WHERE IID = '".$cartItemRow['IID']."'";
			$inventoryResult = mysqli_query($dbconn, $inventoryQuery) or die("Couldn't execute query\n");
			$inventoryRow = $inventoryResult->fetch_array(MYSQLI_ASSOC);

			if($inventoryRow['in_stock'] == 0) //item is out of stock, so remove item from cart
			{
				$deleteCartItemQuery = "DELETE FROM shopping_cart_item WHERE SCID = '$SCID' AND IID = '".$cartItemRow['IID']."'";
				mysqli_query($dbconn, $deleteCartItemQuery) or die("Couldn't execute query\n");
				$canCheckout = false;
			}
			else //item is in stock
			{
				$stockDifference = $inventoryRow['in_stock'] - $cartItemRow['quantity'];
				if($stockDifference < 0) //an item's quantity is greater than the stock, so reduce item's quantity in the cart
				{
					$newQuantity = $cartItemRow['quantity'] + $stockDifference;
					$updateCartItemQuery = "UPDATE shopping_cart_item SET quantity = $newQuantity WHERE SCID = '$SCID' AND IID = '".$cartItemRow['IID']."'";
					mysqli_query($dbconn, $updateCartItemQuery) or die("Couldn't execute query\n");
					$canCheckout = false;
				}
			}
		}

		if($canCheckout == true) //order can be placed
		{
			//get current date and time
			date_default_timezone_set("America/New_York");
			$date = date("Y-m-d H:i:s");

			//get shopping cart info
			$query0 = "SELECT * FROM shopping_cart WHERE SCID = '$SCID'";
			$result0 = mysqli_query($dbconn, $query0) or die("Couldn't execute login data query\n");
			$row0 = $result0->fetch_array(MYSQLI_ASSOC);

			//create new customer order
			$query1 = "INSERT INTO customer_order (CPID, CIID, SCIDtemp, date_stamp, number_of_items, total_price) VALUES ('".$row0['CPID']."', '$CIID', '".$row0['SCID']."', '$date', '".$row0['number_of_items']."', '".$row0['total_price']."')";
			mysqli_query($dbconn, $query1) or die("Couldn't execute login data query\n");

			//get customer order ID
			$query2 = "SELECT COID FROM customer_order WHERE SCIDtemp = '$SCID'";
			$result2 = mysqli_query($dbconn, $query2) or die("Couldn't execute query\n");
			$row2 = $result2->fetch_array(MYSQLI_ASSOC);
			$COID = $row2['COID'];

			//transfer items from cart into customer order
			$query3 = "SELECT IID, quantity FROM shopping_cart_item WHERE SCID = '$SCID'";
			$result3 = mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");
			while($row3 = $result3->fetch_array(MYSQLI_ASSOC))
			{
				$query4 = "INSERT INTO customer_order_item (COID, IID, quantity) VALUES ('$COID', '".$row3['IID']."', '".$row3['quantity']."')";
				mysqli_query($dbconn, $query4) or die("Couldn't execute query\n");
			}

			//update customer profile info
			$query5 = "UPDATE customer_profile SET number_of_purchases = number_of_purchases + 1,  total_money_spent = total_money_spent + (SELECT total_price FROM shopping_cart WHERE SCID = '$SCID'), last_purchase_date = '$date', active_orders = active_orders + 1 WHERE CPID = '$CPID'";
			mysqli_query($dbconn, $query5) or die("Couldn't execute login data query\n");

			//update inventory stock
			$query6 = "SELECT IID, quantity FROM shopping_cart_item WHERE SCID = '$SCID'";
			$result6 = mysqli_query($dbconn, $query6) or die("Couldn't execute query\n");
			while($row6 = $result6->fetch_array(MYSQLI_ASSOC))
			{
				$query7 = "UPDATE inventory SET in_stock = in_stock - '".$row6['quantity']."' WHERE IID = '".$row6['IID']."'";
				mysqli_query($dbconn, $query7) or die("Couldn't execute query\n");
			}

			//empty cart
			$query8 = "DELETE FROM shopping_cart_item WHERE SCID = '$SCID'";
			mysqli_query($dbconn, $query8) or die("Couldn't execute login data query\n");

			$query9 = "UPDATE shopping_cart SET number_of_items = '0', total_price = '0' WHERE SCID = '$SCID'";
			mysqli_query($dbconn, $query9) or die("Couldn't execute login data query\n");

			//dissociate order from cart
			$query10 = "UPDATE customer_order SET SCIDtemp = '-1' WHERE SCIDtemp = '$SCID'";
			mysqli_query($dbconn, $query10) or die("Couldn't execute query\n");

			//order confirmation
			echo "<script type='text/javascript'>alert('Order successfully placed!'); window.location.href = 'customer_shopping.php';</script>";
		}
		else //send back to shopping cart if order could not be placed
		{
			echo "<script type='text/javascript'>alert('Order could not be placed because selected quantity on one or more items could not be fulfilled.'); window.location.href = 'customer_shopping.php';</script>";
		}

	}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
       <!-- <h1>PokéMart Store!</h1>-->

	    <link rel = "stylesheet" href = "shopping_cart.css">

    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

        <form action="checkout.php" method="post">
       
        <h1> Address </h1>
        <p>
				<label> Street address 1: *
					<input type = "text" name  = "street_1" maxlength = "100" autocomplete required />
				</label>  
			</p>
			<p>
				<label> Street address 2: 
					<input type = "text" name  = "street_2" maxlength = "100" autocomplete />
				</label>
			</p>
			<p>
				<label> City: *
					<input type = "text" name  = "city" maxlength = "100" autocomplete required />
				</label>  
			</p>
			<p>
				<label> State <em>(if applicable)</em>:  
					<select name = "state">
						<option value = "" selected></option>
						<option value = "Alabama">Alabama</option>
						<option value = "Alaska">Alaska</option>
						<option value = "Arizona">Arizona</option>
						<option value = "Arkansas">Arkansas</option>
						<option value = "California">California</option>
						<option value = "Colorado">Colorado</option>
						<option value = "Connecticut">Connecticut</option>
						<option value = "Delaware">Delaware</option>
						<option value = "District of Columbia">District of Columbia</option>
						<option value = "Florida">Florida</option>
						<option value = "Georgia">Georgia</option>
						<option value = "Hawaii">Hawaii</option>
						<option value = "Idaho">Idaho</option>
						<option value = "Illinois">Illinois</option>
						<option value = "Indiana">Indiana</option>
						<option value = "Iowa">Iowa</option>
						<option value = "Kansas">Kansas</option>
						<option value = "Kentucky">Kentucky</option>
						<option value = "Louisiana">Louisiana</option>
						<option value = "Maine">Maine</option>
						<option value = "Maryland">Maryland</option>
						<option value = "Massachusetts">Massachusetts</option>
						<option value = "Michigan">Michigan</option>
						<option value = "Minnesota">Minnesota</option>
						<option value = "Mississippi">Mississippi</option>
						<option value = "Missouri">Missouri</option>
						<option value = "Montana">Montana</option>
						<option value = "Nebraska">Nebraska</option>
						<option value = "Nevada">Nevada</option>
						<option value = "New Hampshire">New Hampshire</option>
						<option value = "New Jersey">New Jersey</option>
						<option value = "New Mexico">New Mexico</option>
						<option value = "New York">New York</option>
						<option value = "North Carolina">North Carolina</option>
						<option value = "North Dakota">North Dakota</option>
						<option value = "Ohio">Ohio</option>
						<option value = "Oklahoma">Oklahoma</option>
						<option value = "Oregon">Oregon</option>
						<option value = "Pennsylvania">Pennsylvania</option>
						<option value = "Rhode Island">Rhode Island</option>
						<option value = "South Carolina">South Carolina</option>
						<option value = "South Dakota">South Dakota</option>
						<option value = "Tennessee">Tennessee</option>
						<option value = "Texas">Texas</option>
						<option value = "Utah">Utah</option>
						<option value = "Vermont">Vermont</option>
						<option value = "Virginia">Virginia</option>
						<option value = "Washington">Washington</option>
						<option value = "West Virginia">West Virginia</option>
						<option value = "Wisconsin">Wisconsin</option>
						<option value = "Wyoming">Wyoming</option>
					</select>
				</label>
			</p>
			<p>
				<label> Zip code: *
					<input type = "text" name  = "zip_code" minlength = "5" maxlength = "10" pattern = "^[A-Z\d]+$" autocomplete required />
				</label>  
			</p>
			<p>
				<label> Country: *
					<select name = "country">
						<option value = "Afghanistan">Afghanistan</option>
						<option value = "Albania">Albania</option>
						<option value = "Algeria">Algeria</option>
						<option value = "American Samoa">American Samoa</option>
						<option value = "Andorra">Andorra</option>
						<option value = "Angola">Angola</option>
						<option value = "Anguilla">Anguilla</option>
						<option value = "Antigua and Barbuda">Antigua and Barbuda</option>
						<option value = "Argentina">Argentina</option>
						<option value = "Armenia">Armenia</option>
						<option value = "Aruba">Aruba</option>
						<option value = "Australia">Australia</option>
						<option value = "Austria">Austria</option>
						<option value = "Azerbaijan">Azerbaijan</option>
						<option value = "Bahamas">Bahamas</option>
						<option value = "Bahrain">Bahrain</option>
						<option value = "Bangladesh">Bangladesh</option>
						<option value = "Barbados">Barbados</option>
						<option value = "Belarus">Belarus</option>
						<option value = "Belgium">Belgium</option>
						<option value = "Belize">Belize</option>
						<option value = "Benin">Benin</option>
						<option value = "Bermuda">Bermuda</option>
						<option value = "Bhutan">Bhutan</option>
						<option value = "Bolivia">Bolivia</option>
						<option value = "Bonaire">Bonaire</option>
						<option value = "Bosnia and Herzegovina">Bosnia and Herzegovina</option>
						<option value = "Botswana">Botswana</option>
						<option value = "Brazil">Brazil</option>
						<option value = "British Indian Ocean Territory">British Indian Ocean Territory</option>
						<option value = "Brunei">Brunei</option>
						<option value = "Bulgaria">Bulgaria</option>
						<option value = "Burkina Faso">Burkina Faso</option>
						<option value = "Burundi">Burundi</option>
						<option value = "Cambodia">Cambodia</option>
						<option value = "Cameroon">Cameroon</option>
						<option value = "Canada">Canada</option>
						<option value = "Canary Islands">Canary Islands</option>
						<option value = "Cape Verde">Cape Verde</option>
						<option value = "Cayman Islands">Cayman Islands</option>
						<option value = "Central African Republic">Central African Republic</option>
						<option value = "Chad">Chad</option>
						<option value = "Channel Islands">Channel Islands</option>
						<option value = "Chile">Chile</option>
						<option value = "China">China</option>
						<option value = "Christmas Island">Christmas Island</option>
						<option value = "Cocos Island">Cocos Island</option>
						<option value = "Colombia">Colombia</option>
						<option value = "Comoros">Comoros</option>
						<option value = "Congo">Congo</option>
						<option value = "Cook Islands">Cook Islands</option>
						<option value = "Costa Rica">Costa Rica</option>
						<option value = "Cote DIvoire">Cote DIvoire</option>
						<option value = "Croatia">Croatia</option>
						<option value = "Cuba">Cuba</option>
						<option value = "Curaco">Curacao</option>
						<option value = "Cyprus">Cyprus</option>
						<option value = "Czech Republic">Czech Republic</option>
						<option value = "Denmark">Denmark</option>
						<option value = "Djibouti">Djibouti</option>
						<option value = "Dominica">Dominica</option>
						<option value = "Dominican Republic">Dominican Republic</option>
						<option value = "East Timor">East Timor</option>
						<option value = "Ecuador">Ecuador</option>
						<option value = "Egypt">Egypt</option>
						<option value = "El Salvador">El Salvador</option>
						<option value = "Equatorial Guinea">Equatorial Guinea</option>
						<option value = "Eritrea">Eritrea</option>
						<option value = "Estonia">Estonia</option>
						<option value = "Ethiopia">Ethiopia</option>
						<option value = "Falkland Islands">Falkland Islands</option>
						<option value = "Faroe Islands">Faroe Islands</option>
						<option value = "Fiji">Fiji</option>
						<option value = "Finland">Finland</option>
						<option value = "France">France</option>
						<option value = "French Guiana">French Guiana</option>
						<option value = "French Polynesia">French Polynesia</option>
						<option value = "French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
						<option value = "Gabon">Gabon</option>
						<option value = "Gambia">Gambia</option>
						<option value = "Georgia">Georgia</option>
						<option value = "Germany">Germany</option>
						<option value = "Ghana">Ghana</option>
						<option value = "Gibraltar">Gibraltar</option>
						<option value = "Great Britain">Great Britain</option>
						<option value = "Greece">Greece</option>
						<option value = "Greenland">Greenland</option>
						<option value = "Grenada">Grenada</option>
						<option value = "Guadeloupe">Guadeloupe</option>
						<option value = "Guam">Guam</option>
						<option value = "Guatemala">Guatemala</option>
						<option value = "Guinea">Guinea</option>
						<option value = "Guyana">Guyana</option>
						<option value = "Haiti">Haiti</option>
						<option value = "Hawaii">Hawaii</option>
						<option value = "Honduras">Honduras</option>
						<option value = "Hong Kong">Hong Kong</option>
						<option value = "Hungary">Hungary</option>
						<option value = "Iceland">Iceland</option>
						<option value = "Indonesia">Indonesia</option>
						<option value = "India">India</option>
						<option value = "Iran">Iran</option>
						<option value = "Iraq">Iraq</option>
						<option value = "Ireland">Ireland</option>
						<option value = "Isle of Man">Isle of Man</option>
						<option value = "Israel">Israel</option>
						<option value = "Italy">Italy</option>
						<option value = "Jamaica">Jamaica</option>
						<option value = "Japan">Japan</option>
						<option value = "Jordan">Jordan</option>
						<option value = "Kazakhstan">Kazakhstan</option>
						<option value = "Kenya">Kenya</option>
						<option value = "Kiribati">Kiribati</option>
						<option value = "Kuwait">Kuwait</option>
						<option value = "Kyrgyzstan">Kyrgyzstan</option>
						<option value = "Laos">Laos</option>
						<option value = "Latvia">Latvia</option>
						<option value = "Lebanon">Lebanon</option>
						<option value = "Lesotho">Lesotho</option>
						<option value = "Liberia">Liberia</option>
						<option value = "Libya">Libya</option>
						<option value = "Liechtenstein">Liechtenstein</option>
						<option value = "Lithuania">Lithuania</option>
						<option value = "Luxembourg">Luxembourg</option>
						<option value = "Macau">Macau</option>
						<option value = "Macedonia">Macedonia</option>
						<option value = "Madagascar">Madagascar</option>
						<option value = "Malaysia">Malaysia</option>
						<option value = "Malawi">Malawi</option>
						<option value = "Maldives">Maldives</option>
						<option value = "Mali">Mali</option>
						<option value = "Malta">Malta</option>
						<option value = "Marshall Islands">Marshall Islands</option>
						<option value = "Martinique">Martinique</option>
						<option value = "Mauritania">Mauritania</option>
						<option value = "Mauritius">Mauritius</option>
						<option value = "Mayotte">Mayotte</option>
						<option value = "Mexico">Mexico</option>
						<option value = "Midway Islands">Midway Islands</option>
						<option value = "Moldova">Moldova</option>
						<option value = "Monaco">Monaco</option>
						<option value = "Mongolia">Mongolia</option>
						<option value = "Montserrat">Montserrat</option>
						<option value = "Morocco">Morocco</option>
						<option value = "Mozambique">Mozambique</option>
						<option value = "Myanmar">Myanmar</option>
						<option value = "Nambia">Nambia</option>
						<option value = "Nauru">Nauru</option>
						<option value = "Nepal">Nepal</option>
						<option value = "Netherland Antilles">Netherland Antilles</option>
						<option value = "Netherlands">Netherlands</option>
						<option value = "Nevis">Nevis</option>
						<option value = "New Caledonia">New Caledonia</option>
						<option value = "New Zealand">New Zealand</option>
						<option value = "Nicaragua">Nicaragua</option>
						<option value = "Niger">Niger</option>
						<option value = "Nigeria">Nigeria</option>
						<option value = "Niue">Niue</option>
						<option value = "Norfolk Island">Norfolk Island</option>
						<option value = "North Korea">North Korea</option>
						<option value = "Norway">Norway</option>
						<option value = "Oman">Oman</option>
						<option value = "Pakistan">Pakistan</option>
						<option value = "Palau Island">Palau Island</option>
						<option value = "Palestine">Palestine</option>
						<option value = "Panama">Panama</option>
						<option value = "Papua New Guinea">Papua New Guinea</option>
						<option value = "Paraguay">Paraguay</option>
						<option value = "Peru">Peru</option>
						<option value = "Philippines">Philippines</option>
						<option value = "Pitcairn Island">Pitcairn Island</option>
						<option value = "Poland">Poland</option>
						<option value = "Portugal">Portugal</option>
						<option value = "Puerto Rico">Puerto Rico</option>
						<option value = "Qatar">Qatar</option>
						<option value = "Republic of Montenegro">Republic of Montenegro</option>
						<option value = "Republic of Serbia">Republic of Serbia</option>
						<option value = "Reunion">Reunion</option>
						<option value = "Romania">Romania</option>
						<option value = "Russia">Russia</option>
						<option value = "Rwanda">Rwanda</option>
						<option value = "St. Barthelemy">St. Barthelemy</option>
						<option value = "St. Eustatius">St. Eustatius</option>
						<option value = "St. Helena">St. Helena</option>
						<option value = "St. Kitts-Nevis">St. Kitts-Nevis</option>
						<option value = "St. Lucia">St. Lucia</option>
						<option value = "St. Maarten">St. Maarten</option>
						<option value = "St. Pierre and Miquelon">St. Pierre and Miquelon</option>
						<option value = "St. Vincent and Grenadines">St. Vincent and Grenadines</option>
						<option value = "Saipan">Saipan</option>
						<option value = "Samoa">Samoa</option>
						<option value = "San Marino">San Marino</option>
						<option value = "Sao Tome and Principe">Sao Tome and Principe</option>
						<option value = "Saudi Arabia">Saudi Arabia</option>
						<option value = "Senegal">Senegal</option>
						<option value = "Seychelles">Seychelles</option>
						<option value = "Sierra Leone">Sierra Leone</option>
						<option value = "Singapore">Singapore</option>
						<option value = "Slovakia">Slovakia</option>
						<option value = "Slovenia">Slovenia</option>
						<option value = "Solomon Islands">Solomon Islands</option>
						<option value = "Somalia">Somalia</option>
						<option value = "South Africa">South Africa</option>
						<option value = "South Korea">South Korea</option>
						<option value = "Spain">Spain</option>
						<option value = "Sri Lanka">Sri Lanka</option>
						<option value = "Sudan">Sudan</option>
						<option value = "Suriname">Suriname</option>
						<option value = "Swaziland">Swaziland</option>
						<option value = "Sweden">Sweden</option>
						<option value = "Switzerland">Switzerland</option>
						<option value = "Syria">Syria</option>
						<option value = "Tahiti">Tahiti</option>
						<option value = "Taiwan">Taiwan</option>
						<option value = "Tajikistan">Tajikistan</option>
						<option value = "Tanzania">Tanzania</option>
						<option value = "Thailand">Thailand</option>
						<option value = "Togo">Togo</option>
						<option value = "Tokelau">Tokelau</option>
						<option value = "Tonga">Tonga</option>
						<option value = "Trinidad and Tobago">Trinidad and Tobago</option>
						<option value = "Tunisia">Tunisia</option>
						<option value = "Turkey">Turkey</option>
						<option value = "Turkmenistan">Turkmenistan</option>
						<option value = "Turks and Caicos Islands">Turks and Caicos Islands</option>
						<option value = "Tuvalu">Tuvalu</option>
						<option value = "Uganda">Uganda</option>
						<option value = "United Kingdom">United Kingdom</option>
						<option value = "Ukraine">Ukraine</option>
						<option value = "United Arab Erimates">United Arab Emirates</option>
						<option value = "United States of America" selected>United States of America</option>
						<option value = "Uraguay">Uruguay</option>
						<option value = "Uzbekistan">Uzbekistan</option>
						<option value = "Vanuatu">Vanuatu</option>
						<option value = "Vatican City">Vatican City</option>
						<option value = "Venezuela">Venezuela</option>
						<option value = "Vietnam">Vietnam</option>
						<option value = "British Virgin Islands">British Virgin Islands</option>
						<option value = "U.S. Virgin Islands">U.S. Virgin Islands</option>
						<option value = "Wake Island">Wake Island</option>
						<option value = "Wallis and Futana">Wallis and Futana</option>
						<option value = "Yemen">Yemen</option>
						<option value = "Zaire">Zaire</option>
						<option value = "Zambia">Zambia</option>
						<option value = "Zimbabwe">Zimbabwe</option>
					</select>
				</label>
			</p>
			<br>
            <br>
            <br>
            <h2> Card Information </h2>
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
            <br>
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
        	<!-- Submit form data -->
			<p>
				<input type =  "submit" id = "submit" name = "submit" value = "Checkout" />
			</p>

		</form>
    </body>
</html>
