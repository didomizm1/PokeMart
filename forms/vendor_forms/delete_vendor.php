<?php
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	//variables that hold vendor data inserted from html form
	$vendor_name=$_POST['vendor_name'];
	$vendor_code=$_POST['vendor_code'];
	$VID=$_POST['VID'];
	//query setup to delete vendor
	$query="DELETE FROM vendors WHERE vendor_name='$vendor_name' AND vendor_code='$vendor_code AND VID='$VID'";
	//execute query
	$result=mysqli_query($dbconn,$query) or die("Couldn't execute query");
	
}
?>
