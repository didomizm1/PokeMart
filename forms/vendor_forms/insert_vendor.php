<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	//setup query;insert into vendors table
	$query="INSERT INTO `vendors` (`vendor_name`, `vendor_code`, `vendor_city`, `vendor_region`, `vendor_country`, `vendor_zip_code`, `vendor_contact_name`, `vendor_contact_title`, `vendor_contact_route`, `vendor_contact_number`) VALUES ('".$_POST['vendor_name']."','".$_POST['vendor_code']."','".$_POST['vendor_city']."','".$_POST['vendor_region']."','".$_POST['vendor_country']."','".$_POST['vendor_zip_code']."','".$_POST['vendor_contact_name']."','".$_POST['vendor_contact_title']."', '".$_POST['vendor_contact_route']."','".$_POST['vendor_contact_number']."')";

	//execute query
	if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Vendor added successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>
