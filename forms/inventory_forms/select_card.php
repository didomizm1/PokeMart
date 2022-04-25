<?php
	//session handling
	require_once('../session.php');

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
       
		<fieldset id = address >
		<a href = "existing_checkout.php">
        <h1> Existing Card </h1>
		</a>
        

		<img id = "sleeping_skitty" src = "../../img/lnt/sleeping_skitty.gif" alt = "sleeping skitty" width ="300">

		<br>
		</fieldset>
			</td>
			<td>
	
		<fieldset id= payment>
		<a href = "new_checkout.php">
		<h1> New Card </h1>
		</a>

		<img id = "clefairy" src = "../../img/lnt/clefairy.gif" alt = "clefairy" width ="300">

		<br>

		
		
		</fieldset>
		</td>
		</tr>
		</table>
        	
		</form>
    </body>
</html>
