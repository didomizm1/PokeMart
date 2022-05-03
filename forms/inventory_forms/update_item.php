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

	//execute queries
	mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
	header('Location: employee_inventory.php');
}

?>