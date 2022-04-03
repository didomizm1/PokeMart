<?php
//session handling
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	$IID=$_POST['IID'];
	$info=$_POST['info'];
	$update=$_POST['update'];

	//setup query
	$query="UPDATE inventory SET $info='$update' WHERE IID='$IID'";

	//execute query
	if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Item updated successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>