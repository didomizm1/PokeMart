<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');
    $month=$_POST['month'];
    $year=$_POST['year'];

    //queries to fetch data
    //store expenses
    $query1="SELECT * FROM store_expense WHERE month='$month' AND year='$year'";
    $result1=mysqli_query($dbconn, $query1);
    $row1 = $result1->fetch_assoc(); 
    //salary
    $query2="SELECT SUM(salary) AS salary_sum FROM employee_profile";
    $result2=mysqli_query($dbconn, $query2);
    $row2=$result2->fetch_assoc();
    $salary=$row2['salary_sum']/12; //salary divided by 12 months to get monthly pay
    //total expenses
    $total_expenses=$row1['rent'] + $row1['utilities'] + $row1['other_expenses'] + $salary;
    //net sales
    $query3="SELECT SUM(total_price) AS net_sales FROM customer_order WHERE YEAR(date_stamp) = '$year' AND MONTH(date_stamp) = '$month' AND refunded='0'";
    $result3=mysqli_query($dbconn, $query3);
    $row3=$result3->fetch_assoc();
    //cost of goods
    $query4="SELECT SUM(selling_price) AS cost FROM inventory 
    INNER JOIN customer_order_item ON inventory.IID = customer_order_item.IID
    INNER JOIN customer_order ON customer_order_item.COID = customer_order.COID
    WHERE YEAR(customer_order.date_stamp) = '$year' AND MONTH(customer_order.date_stamp) = '$month'";
    $result4=mysqli_query($dbconn, $query4);
    $row4=$result4->fetch_assoc();
    //gross profit
    $profit=$row3['net_sales']-$row4['cost'];
    //net income
    $net_income=$profit-$total_expenses;
    	

}?>

<!DOCTYPE html>
<html>
<head>
	<title>Profit/Loss</title>
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
  border: 5px outset orange;
  background-color: white;    
  text-align: center;
  width:60%;
  margin-left:auto;
  margin-right:auto;
  
}
    body{
    background-image:url('../../img/lnt/expenses.gif');
    background-size:cover;
}
</style>
<body>
<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG SRC="../../img/lnt/logo.png" class="center">
  </a>
  <div class="div">
  <h1 style="text-align: center">Profit & Loss Statement</h1>
  <br>
  <?php
if(isset($_POST['submit']))
{

    echo "Month: " . $month;
    echo "</br>";  
    echo "Year: " . $year;
    echo "</br>"; 
    echo "</br>"; 
    echo "Net sales: $" . number_format((float)$row3['net_sales'],2,'.','');
    echo "</br>"; 
    echo "Cost of goods: $" .$row4['cost'];
    echo "</br>"; 
    echo "Gross profit: $" . $profit;
    echo "</br>"; 
    echo "</br>"; 
    echo "Salary: $" . $salary;
    echo "</br>";  
	echo "Rent: $" . $row1['rent'];
    echo "</br>";  
    echo "Utilities: $" . $row1['utilities'];
    echo "</br>";  
    echo "Other expenses: $" . $row1['other_expenses'];
    echo "</br>";  
    echo " Total expenses: $" . number_format((float)$total_expenses,2,'.','');
    echo "</br>";  
    echo "</br>"; 
    echo "Net income: $" . $net_income;
   
	

}?>

</div>
</body>	
</html>