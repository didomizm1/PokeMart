<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	$EPID=$_POST['EPID'];
    $date=$_POST['date'];

	//setup query, selects row where EPID matches input
	$query="SELECT * FROM z_report WHERE EPID='$EPID' AND date='$date'";

	//execute query and display in table
    $result=mysqli_query($dbconn, $query);
		if(mysqli_num_rows($result) > 0)
		{
        echo "<table>";
            echo "<tr>";
                echo "<th>ZRID</th>";
                echo "<th>EPID</th>";
                echo "<th>Date</th>";
                echo "<th>Start Time</th>";
                echo "<th><End Time/th>";
                echo "<th>Total Cash Started</th>";
                echo "<th>Total Cash Ended</th>";
                echo "<th>Cash Difference</th>";
                echo "<th>Items Sold</th>";
                echo "<th>Number of Transactions</th>";
                echo "<th>Cash Sales</th>";
                echo "<th>Credit Sales</th>";
                echo "<th>Total Sales</th>";
                echo "<th>Cash Refunds</th>";
                echo "<th>Credit Refunds</th>";
                echo "<th>Total Refunds</th>";
            echo "</tr>";
        while($row = $result->fetch_assoc())
        {
            echo "<tr>";
                echo "<td>" . $row['ZRID'] . "</td>";
                echo "<td>" . $row['EPID'] . "</td>";
                echo "<td>" . $row['date'] . "</td>";
                echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                echo "<td>" . $row['total_cash_started'] . "</td>";
                echo "<td>" . $row['total_cash_ended'] . "</td>";
                echo "<td>" . $row['cash_difference'] . "</td>";
                echo "<td>" . $row['items_sold'] . "</td>";
                echo "<td>" . $row['number_of_transactions'] . "</td>";
                echo "<td>" . $row['cash_sales'] . "</td>";
                echo "<td>" . $row['credit_sales'] . "</td>";
                echo "<td>" . $row['total_sales'] . "</td>";
                echo "<td>" . $row['cash_refunds'] . "</td>";
                echo "<td>" . $row['credit_refunds'] . "</td>";
                echo "<td>" . $row['total_refunds'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
    else
    {
        echo "No records matching EPID were found.";//if input doesn't match an employee in the database
    }
}?>
<!DOCTYPE html>
<html>