<?php
//protects file, only employees can acesss
require_once('../employee_session.php');

//connect to database
include_once('../connect_mysql.php');
if(isset($_POST['submit']))
{
    //variables
    $month=$_POST['month'];
    $year=$_POST['year'];
    $expense=$_POST['expense'];
    $cost=$_POST['cost'] ;

    //setup query, adds the cost to the specific cell depending on month, year and type of expense
    $query="UPDATE profit_loss_report SET $expense+='$cost' WHERE month='$month' AND year='$year";

    //execute query
    if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Expense added successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }

}   

?>