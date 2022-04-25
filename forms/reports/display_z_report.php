<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');
    $date=$_POST['date'];

    //queries to fetch data
    //gets total number of items sold
    $query1="SELECT SUM(number_of_items) AS items_sold FROM customer_order WHERE DATE(date_stamp)='$date' AND refunded='0'";
    $result1=mysqli_query($dbconn, $query1);
    $row1=$result1->fetch_assoc();
    //gets total number of transactions
    $query2="SELECT COUNT(*) AS transactions FROM customer_order WHERE DATE(date_stamp)='$date' AND refunded='0'";
    $result2=mysqli_query($dbconn, $query2);
    $row2=$result2->fetch_assoc();
    //gets total sales
    $query3="SELECT SUM(total_price) AS total_sales FROM customer_order WHERE DATE(date_stamp)='$date' AND refunded='0'";
    $result3=mysqli_query($dbconn, $query3);
    $row3=$result3->fetch_assoc();
    //credit sales
    //VISA
    $query4="SELECT SUM(customer_order.total_price) AS visa FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE DATE(customer_order.date_stamp)='$date' AND card_info.card_type='Visa' AND customer_order.refunded='0'";
    $result4=mysqli_query($dbconn, $query4);
    $row4=$result4->fetch_assoc();
    //Mastercard
    $query5="SELECT SUM(customer_order.total_price) AS mastercard FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE DATE(customer_order.date_stamp)='$date' AND card_info.card_type='Mastercard' AND customer_order.refunded='0'";
    $result5=mysqli_query($dbconn, $query5);
    $row5=$result5->fetch_assoc();

    //Discover
    $query6="SELECT SUM(customer_order.total_price) AS discover FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE DATE(customer_order.date_stamp)='$date' AND card_info.card_type='Discover' AND customer_order.refunded='0'";
    $result6=mysqli_query($dbconn, $query6);
    $row6=$result6->fetch_assoc();
   
    //American Express
    $query7="SELECT SUM(customer_order.total_price) AS american FROM customer_order
    INNER JOIN card_info
    ON customer_order.CIID=card_info.CIID
    WHERE DATE(customer_order.date_stamp)='$date' AND card_info.card_type='American Express' AND customer_order.refunded='0'";
    $result7=mysqli_query($dbconn, $query7);
    $row7=$result7->fetch_assoc();

    //refunds
    $query8="SELECT SUM(total_price) AS refunds FROM customer_order WHERE DATE(date_stamp)='$date' AND refunded='1'";
    $result8=mysqli_query($dbconn, $query8);
    $row8=$result8->fetch_assoc();
    //gets total number of refunds
    $query9="SELECT COUNT(*) AS no_refunds FROM customer_order WHERE DATE(date_stamp)='$date' AND refunded='1'";
    $result9=mysqli_query($dbconn, $query9);
    $row9=$result9->fetch_assoc();
     

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
    body{
    background-image:url('../../img/lnt/z_report_background.gif');
    background-size:cover;
} 
    .div {
    border: 5px outset lightblue;
    background-color: white;    
    text-align: center;
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
    <h1 style="text-align: center">Z-Report</h1>
  <?php
    if(isset($_POST['submit']))
{
    echo "Date: " . $date;
    echo "</br>";  
    echo "</br>"; 
    echo "SALES SUMMARY:";
    echo "</br>"; 
    if(empty($row1['items_sold']))
    {
        echo "Items Sold: 0" ;
    }
    else
    {
        echo "Items Sold: " . $row1['items_sold'];
    }
    echo "</br>";  
    echo "Transactions: " . $row2['transactions'];
    echo "</br>";  
    echo "</br>"; 
    echo "PAYMENT DETAILS:";
    echo "</br>"; 
    if(empty($row4['visa']))
    {
        echo "Visa: $0.00";
    }
    else
    {
        echo "Visa: $" . $row4['visa'];   
    }
    
    echo "</br>";  
    if(empty($row5['mastercard']))
    {
        echo "Mastercard: $0.00";
    }
    else
    {
       echo "Mastercard: $" . $row5['mastercard']; 
    }
    
    echo "</br>";  
    if(empty($row6['discover']))
    {
        echo "Discover: $0.00";
    }
    else
    {
        echo "Discover: $" . $row6['discover'];
    }
    
    echo "</br>";  
    if(empty($row7['american']))
    {
        echo "American Express: $0.00";
    }
    else
    {
        echo "American Express: $" . $row7['american'];
    }
    
    echo "</br>"; 
    if(empty($row3['total_sales'])) 
    {
        echo "Total Sales: $0.00";
    }
    else
    {
        echo "Total Sales: $" . $row3['total_sales'];
    }
    echo "</br>"; 
    echo "</br>"; 
    echo "REFUNDS:" ;
    echo "</br>"; 
    echo "Refunds: " . $row9['no_refunds'];
    echo "</br>"; 
    if(empty($row8['refunds']))
    {
        echo "Total Refunds: $0.00";
    }
    else
    {
       echo "Total Refunds: $"  . $row8['refunds']; 
    }
    echo "</br>"; 
    echo "</br>"; 

}?>
</div>
</body>	
</html>