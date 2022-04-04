<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');
    $date=$_POST['date'];

    //initializing variables
    $items_sold=0;
    $number_of_transactions=0;
    $cash_sales=0.00;
    $credit_sales=0.00;
    $total_sales=0.00;
    $cash_refunds=0.00;
    $credit_refunds=0.00;
    $total_refunds=0.00;

    //setup query, selects all data from table z_report from a certain date
	$query="SELECT * FROM z_report WHERE date='$date";

	//execute query and display in table
    $result=mysqli_query($dbconn, $query);
		if(mysqli_num_rows($result) > 0)
		{
        echo "<table>";
            echo "<tr>";
                echo "<th>Items Sold</th>";
                echo "<th>Number of Transactions</th>";
                echo "<th>Cash Sales</th>";
                echo "<th>Credit Sales</th>";
                echo "<th>Total Sales</th>";
                echo "<th>Cash Refunds</th>";
                echo "<th>Credit Refunds</th>";
                echo "<th>Total Refunds</th>";
            echo "</tr>";
            //sums these specific columns
        while($row = $result->fetch_assoc())
        {
            $items_sold+=$row['items_sold'];
            $number_of_transactions+=$row['number_of_transactions'];
            $cash_sales+=$row['cash_sales'];
            $credit_sales+=$row['credit_sales'];
            $total_sales+=$row['total_sales'];
            $cash_refunds+=$row['cash_refunds'];
            $credit_refunds+=['credit_refunds'];
            $total_refunds+=['total_refunds'];
           
        }
        echo "<tr>";
        echo "<td>" . $items_sold. "</td>";
        echo "<td>" . $number_of_transactions . "</td>";
        echo "<td>" . $cash_sales . "</td>";
        echo "<td>" . $credit_sales . "</td>";
        echo "<td>" . $total_sales . "</td>";
        echo "<td>" . $cash_refunds . "</td>";
        echo "<td>" . $credit_refunds . "</td>";
        echo "<td>" . $total_refunds . "</td>";
        echo "</tr>";
        echo "</table>";
    }
    else{
        echo "There is no data in the z_report table on the given date";//if no data exists
    }

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
  	width: 25%;
	}
	/*submit button*/
	input[type=submit] {
  background-color: #FFA500;
  border: none;
  border-radius:50px;
  color: white;
  padding: 10px 32px;
  text-decoration: none;
  margin: 1px 1px;
  cursor: pointer;
}
/* input border */
input[type=date] {
  width: 20%;
  padding: 10px 18px;
  margin: 8px 0;
  margin-top:18%;
  box-sizing: border-box;
  border: 2px solid orange;
  border-radius:50px;
}
/*focuses/highlights box when inputting*/
input[type=date]:focus {
  background-color: #efbf67;
}
body{
  background-image:url('../../img/lnt/z_report_background.gif');
      background-size:cover;
} 
 #logo
    {
      margin-left:0.5%;
      margin-top:1%;
      width:27.25%;
    }
</style>
<body>
	<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png">
  </a>
	<IMG SRC ="../../img/lnt/z_report2.png" class="center" >
	<h2 style="text-align: center">Enter a date, then press submit to get the Z-Report for that day</h2>
	<form action="lookup_z_report.php" method="POST" style="text-align: center">
			Date: <input type="date" name="date" required>
			<br><br>
			<input type="submit" name="submit" value="Submit">
	</form>
</html>