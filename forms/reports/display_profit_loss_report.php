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
    $query="SELECT COUNT(*) AS expenses FROM store_expense WHERE month='$month' AND year='$year'";
    $result=mysqli_query($dbconn, $query);
    $row = $result->fetch_assoc(); 
    if($row['expenses']==0)//checking if expenses exist
    {
        $total_expenses=$salary;//total expenses=salary since no other expenses exist
    }
    else{
       $total_expenses=$row1['rent'] + $row1['utilities'] + $row1['other_expenses'] + $salary; 
    }
    
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
  width:35%;
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
  <h4>1 Hawk Dr, New Paltz, NY 12561</h4>
  <h4>(845)257-7869</h4>
  <h4>pokemart@newpaltz.edu</h4>  
  <h1>Profit & Loss Statement</h1>
  
  <br>
  <?php
if(isset($_POST['submit']))
{

    echo "Month: " . $month;
    echo "</br>";  
    echo " Year: " . $year;
    echo "</br>"; 
    echo "</br>"; 
    echo "<b>INCOME:</b>";
    echo "</br>"; 
    if(empty($row['net_sales']))
    {
        echo "Net Sales: $0.00";
    }
    else{
       echo "Net Sales: $" . number_format((float)$row3['net_sales'],2,'.',''); 
    }
    
    echo "</br>"; 
    if(empty($row['cost']))
    {
        echo "Cost Of Goods: $0.00";
    }
    else{
        echo "Cost Of Goods: $" .$row4['cost'];
    }
    
    echo "</br>"; 
    echo "Gross Profit: $" . $profit;
    echo "</br>"; 
    echo "</br>"; 
    echo "<b>OPERATING EXPENSES:</b>";
    echo "</br>"; 
    //if no expenses exist for that month and year display 0.00 for those expenses
    if($row['expenses']==0)
    {
        echo "Salary: $" . number_format((float)$salary,2,'.','');
        echo "</br>";  
	    echo "Rent: $0.00" ;
        echo "</br>";  
        echo "Utilities: $0.00";
        echo "</br>";  
        echo "Other Expenses: $0.00";
        echo "</br>";  
    }
    else{
        echo "Salary: $" . number_format((float)$salary,2,'.','');
        echo "</br>";  
	    echo "Rent: $" . $row1['rent'];
        echo "</br>";  
        echo "Utilities: $" . $row1['utilities'];
        echo "</br>";  
        echo "Other Expenses: $" . $row1['other_expenses'];
        echo "</br>";  
    }
    echo "Total Expenses: $" .number_format((float)$total_expenses,2,'.','');
    echo "</br>";  
    echo "</br>"; 
    echo "<b>PROFIT/LOSS:</b>";
    echo "</br>"; 
    echo "Net Income: $" . number_format((float)$net_income,2,'.','');
    echo "</br>"; 
    echo "</br>"; 
	

}?>

</div>
</body>	
</html>