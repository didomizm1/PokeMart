<?php
    //connect to database
	include_once('../connect_mysql.php');
    //session handling
	require_once('../session.php');
    //get user profile data associated with logged in user
	$SCID = $_SESSION['SCID'];
	//get customer profile info associated with logged in user
	$CPID = $_SESSION['CPID'];
    
  	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Order Confirmation</title>
</head>
<style>
    	/* centers images */
	.center {
  	display: block;
  	margin-left: auto;
  	margin-right: auto;
  	width: 30%;
	}
    .div {
  border: 5px outset lightgreen;
  border-radius: 50px; 
  background-color: lightpink;    
  text-align: center;
  width:50%;
  margin-left:auto;
  margin-right:auto;
  
}
    body{
    background-image:url('../../img/lnt/checkout_background.gif');
    background-size:cover;
}
    /*link color*/
    a:link {
  	color:lightcoral; 
  	background-color: lightgreen; 
  	text-decoration: none;
    padding: 15px;
    border-radius:50px;
    text-align:center;
    display:inline-block;

}
    
#img
{
  width:35%;
  margin-left:auto;
  margin-right:auto;
}
</style>
<body>
<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG SRC="../../img/lnt/logo.png" class="center">
  </a>
  <div class="div">
  <h1>THANK YOU FOR YOUR ORDER</h1>
  <br>
  <h3>Your order was placed successfully!</h3>
  <br>
  <IMG id="img" SRC="../../img/lnt/purchase_confirmation.gif" >
  <br>
  <br>
  <?php
        $query = "SELECT * FROM customer_order WHERE CPID = '$CPID' AND date_stamp=(SELECT MAX(date_stamp) FROM customer_order WHERE CPID='$CPID')";
        $result = mysqli_query($dbconn, $query);
        $row = $result->fetch_assoc();

        echo "<b> Order Number: </b>" . str_pad($row['COID'],6,'0',STR_PAD_LEFT);
        echo "</br>";  
        echo "<b> Order Date: </b>" . $row['date_stamp'];
        echo "</br>";  
        echo "</br>";  
        echo "<b> Order Summary: </b>";
        echo "</br>";  
        echo "<b> Items Purchased: </b>" .$row['number_of_items'];
        echo "</br>";  
        echo "<b> Total: </b>" . $row['total_price'];
        echo "</br>"; 
        echo "</br>"; 
                                   
    ?>
    <a href='../inventory_forms/customer_order_history.php'>Order History</a>
    <a href='../inventory_forms/customer_shopping.php'>Shop Again</a>
    <br>
    <br>
</div>
</body>	
</html>