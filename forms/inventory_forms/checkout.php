<?php
    //session handling
	require_once('../session.php');

    //connect to database
	include_once('../connect_mysql.php');

	//get user profile data associated with logged in user
	$SCID = $_SESSION['SCID'];
	//get customer profile info associated with logged in user
	$CPID = $_SESSION['CPID'];

	if(isset($_POST['submit']))
	{
        function getCIID($dbconn, $card_number) //returns CIID for a given card number
        {
            $cardIDQuery = "SELECT CIID FROM card_info WHERE card_number = '$card_number'";
            $cardIDResult = mysqli_query($dbconn, $cardIDQuery) or die("Couldn't store card data\n");
            $cardIDRow = $cardIDResult->fetch_array(MYSQLI_ASSOC);
            return $cardIDRow['CIID'];
        }

        $CIID; //card id
		if(isset($_POST['existing_card']))
        {
            //get CIID
            $existing_card = $_POST['existing_card'];
            $CIID = getCIID($dbconn, $existing_card);
        }
        else
        {
            //insert new card
            $cardQuery = "INSERT INTO card_info (`CPID`,`card_holder_name`,`card_number`,`cvv`,`month`,`year`,`street_add_1`,`street_add_2`,`city`,`zip_code`)
            VALUES ('$CPID','".$_POST['full_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['year']."','".$_POST['street_1']."','".$_POST['street_2']."','".$_POST['city']."','".$_POST['zip_code']."')";    

            mysqli_query($dbconn, $cardQuery) or die("Couldn't store card data\n");	

            //get CIID
            $CIID = getCIID($dbconn, $_POST['card_number']);
        }

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
			$query1 = "INSERT INTO customer_order (CPID, CIID, SCIDtemp, date_stamp, number_of_items, total_price, refunded) VALUES ('".$row0['CPID']."', '$CIID', '".$row0['SCID']."', '$date', '".$row0['number_of_items']."', '".$row0['total_price']."', '0')";
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
			echo "<script type='text/javascript'>window.location.href = 'purchase_confirmation.php';</script>";
		}
		else //send back to shopping cart if order could not be placed
		{
			echo "<script type='text/javascript'>alert('Order could not be placed because selected quantity on one or more items could not be fulfilled.'); window.location.href = 'customer_shopping.php';</script>";
		}

	}
?>