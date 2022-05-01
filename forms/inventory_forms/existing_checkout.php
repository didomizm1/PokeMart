<?php
	//session handling
	require_once('../checkout_session.php');
	
	//connect to database
	include_once('../connect_mysql.php');

	//get customer profile info associated with logged in user
	$CPID = $_SESSION['CPID'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Checkout</title>
       <!-- <h1>PokéMart Store!</h1>-->

	    <link rel = "stylesheet" href = "checkout.css">

    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

		
        <img id = "checkout" src = "../../img/lnt/checkout_text.png" alt = "checkout" width ="300">
        
		<a href = "shopping_cart.php">
        <img id = "back_to_cart" src = "../../img/lnt/back_to_cart.png" alt = "back to cart" width ="300">
        </a>

		
        <form action="checkout.php" method="post">

		<table>
		<tr>
	
		<td>
		<fieldset id= payment>
            <h1> Payment Information </h1>
            <br>

		<label> Select an existing card: 
			<select id="existing_card" name="existing_card">

			<br>
			<?php
			//dropdown for card numbers
				$query="SELECT card_number FROM card_info WHERE CPID = '$CPID'";
				$result=mysqli_query($dbconn, $query);
				while ($row = $result->fetch_assoc())
				{
					$existing_card_number = $row['card_number'];
					echo "<option value=\"$existing_card_number\">" . $existing_card_number . "</option>";
				}	
					
			?>

		</select>
		</label>
		<br>

		
		<br><br>
		<img id = "trainer_card" src = "../../img/lnt/trainer_id_card.jpeg" alt = "trainer ID" width ="300">
        <br>
        <br>
		</fieldset>
				</td>
		</tr>
				</table>
        	<!-- Submit form data -->
			<p>
				<input type =  "submit" id = "submit" name = "submit" value = "Checkout" />
			</p>

		</form>
    </body>
</html>
