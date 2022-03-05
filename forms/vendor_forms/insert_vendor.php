<?php
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	//setup query;insert into vendors table
	$query="INSERT INTO `vendors` (`vendor_name`, `vendor_code`, `vendor_city`, `vendor_region`, `vendor_country`, `vendor_zip_code`, `vendor_contact_name`, `vendor_contact_title`, `vendor_contact_route`, `vendor_contact_number`) VALUES ('".$_POST['vendor_name']."','".$_POST['vendor_code']."','".$_POST['vendor_city']."','".$_POST['vendor_region']."','".$_POST['vendor_country']."','".$_POST['vendor_zip_code']."','".$_POST['vendor_contact_name']."','".$_POST['vendor_contact_title']."', '".$_POST['vendor_contact_route']."','".$_POST['vendor_contact_number']."')";

	//execute query
	$result=mysqli_query($dbconn, $query) or die("Couldn't execute query\n");

}
?>
