<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');
    $date=$_POST['date'];

    //queries to fetch data
    //gets total number of items sold
    $query1="SELECT SUM(number_of_items) FROM customer_order WHERE DATE(date_stamp)='$date'";
    $result1=mysqli_query($dbconn, $query1);
    $row1=$result1->fetch_assoc();
    //gets total number of transactions
    $query2="SELECT COUNT(*) FROM customer_order WHERE DATE(date_stamp)='$date'";
    $result2=mysqli_query($dbconn, $query2);
    $row2=$result2->fetch_assoc();
    //gets total sales
    $query3="SELECT SUM(total_price) FROM customer_order WHERE DATE(date_stamp)='$date' AND refunded='0'";
    $result3=mysqli_query($dbconn, $query3);
    $row3=$result3->fetch_assoc();
    //credit sales
    //VISA
    $query4="SELECT SUM(customer_order.total_price) FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE customer_order.DATE(date_stamp)='$date' AND card_info.card_type='Visa' AND customer_order.refunded='0'";
    $result4=mysqli_query($dbconn, $query4);
    $row4=$result4->fetch_assoc();
    //Mastercard
    $query5="SELECT SUM(customer_order.total_price) FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE customer_order.DATE(date_stamp)='$date' AND card_info.card_type='Mastercard' AND customer_order.refunded='0'";
    $result5=mysqli_query($dbconn, $query5);
    $row5=$result5->fetch_assoc();

    //Discover
    $query6="SELECT SUM(customer_order.total_price) FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE customer_order.DATE(date_stamp)='$date' AND card_info.card_type='Discover' AND customer_order.refunded='0'";
    $result6=mysqli_query($dbconn, $query6);
    $row6=$result6->fetch_assoc();
   
    //American Express
    $query7="SELECT SUM(customer_order.total_price) FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE customer_order.DATE(date_stamp)='$date' AND card_info.card_type='American Express' AND customer_order.refunded='0'";
    $result7=mysqli_query($dbconn, $query7);
    $row7=$result7->fetch_assoc();

    //refunds
    $query8="SELECT SUM(total_price) FROM customer_order WHERE DATE(date_stamp)='$date' AND refunded='1'";
    $result8=mysqli_query($dbconn, $query8);
    $row8=$result8->fetch_assoc();
   



    



  

}?>

<!DOCTYPE html>
<html>
<head>
	<title>Z-Report</title>
</head>
<style>
    /* centers images */
	.center {
  	display: block;
  	margin-left: auto;
  	margin-right: auto;
  	width: 30%;
	}
    
</style>
<body>
<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG SRC="../../img/lnt/logo.png" class="center">
  </a>
  <h1 style="text-align: center">Z-Report</h1>
  <?php
    if(isset($_POST['submit']))
{
    echo "Date: " . $date;
    echo "</br>";  
    echo "Items sold: " . $row1[0];
    echo "</br>";  
    echo "Transactions: " . $row2[0];
    echo "</br>";  
    echo "Visa: " . $row4[0];
    echo "</br>";  
    echo "Mastercard: " . $row5[0] ;
    echo "</br>";  
    echo "Discover: " . $row6[0];
    echo "</br>";  
    echo "American Express: " . $row7[0];
    echo "</br>";  
    echo "Total sales: " . $row3[0];
    echo "</br>";  
    echo "Total refunds: "  . $row8[0];

  



    
	

}?>
	
</html>