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

<!DOCTYPE html>
<html>
<head>
	<title>Delete Vendor Form</title>
	<style>
	/* input border */
	input[type=text],input[type=number] {
  	 margin: 8px 0;
    border: 2px solid orange;
    border-radius: 50px;
    width:40%;
	}
	/*focuses/highlights box when inputting*/
	input[type=text]:focus {
  	background-color: #76E8AF;
	}
	/* Delete button */
	input[type=submit] {
 	 background-color: #FF0000;
  	border: none;
  	border-radius:50px;
  	color: white;
  	padding: 10px 32px;
  	text-decoration: none;
  	margin-left:30%;
  	cursor: pointer;
	}
	body{
	background-image:url('../../img/lnt/vendor_background2.gif');
      background-size:cover;
	} 
	/*scales imgs*/
 	#logo
    {
      margin-left:0.5%;
      margin-top:1%;
       width:27.25%;
    }
	#img
	{
  		width:35%;
  		margin-left:30%;
	}

	/*puts form into box*/
	#form
	{  
    background: rgb(125, 235, 253);
    border: solid rgb(34, 172, 226) 25px;  
    border-radius: 50px;   
    margin-left: auto;
  	margin-right: auto;   
    padding: 70px;  
    width: 25%; 
	}  

	/* centers images */
	.center {
  	display: block;
  	margin-left: auto;
  	margin-right: auto;
  	width: 30%;
	}
	</style>
</head>
<body>
	<a href = "../home_page/index.php"><!-- makes logo link to homepage -->
      <IMG id="logo"SRC="../../img/lnt/logo.png" >
  </a>
	<IMG SRC ="../../img/lnt/Delete-Vendors.png" class="center">
	<br>
	<form id="form" action="delete_vendor.php" method="POST">
		<IMG id="img" SRC="../../img/lnt/snorlax.gif" ><!-- inserts gif -->
		<h3 style="text-align: center">Insert the following vendor data and click "Delete" when done</h3>
		<h5 style="text-align: center">Caution: this will permanently delete the vendor from the database</h5><br>
		<!-- vendor name,code, and id are all needed in order to delete vendor -->
		<label for= "vendor_name"> * Vendor Name: </label>
			<input type="text" name="vendor_name" required>
			<br><br>
		<label for="vendor_code">* Vendor Code: </label>
			<input type="text" name="vendor_code" required>
			<br><br>
		<label for="VID">* Vendor ID: </label>
			<input type="number" value="VID" name="VID" required>
			<br><br>
			<input type="submit" value="Delete" name="submit">
	</form>
</body>
</html>
