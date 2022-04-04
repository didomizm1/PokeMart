<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	//variables that hold vendor data inserted from html form
	$vendor_name=$_POST['vendor_name'];
	$vendor_code=$_POST['vendor_code'];
	$VID=$_POST['VID'];
	//query setup to delete vendor where vendor name,code and id match
	$query="DELETE FROM vendors WHERE vendor_name='$vendor_name' AND vendor_code='$vendor_code' AND VID='$VID'";
	//execute query
	if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Vendor deleted successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>
