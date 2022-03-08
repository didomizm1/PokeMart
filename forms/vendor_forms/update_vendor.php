<?php
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	$vendor_name=$_POST['vendor_name'];
	$info=$_POST['info'];
	$update=$_POST['update'];

	//setup query
	$query="UPDATE vendors SET $info='$update' WHERE vendor_name='$vendor_name'";

	//execute query
	if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Vendor updated successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>