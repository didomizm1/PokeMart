<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	$vendor_name=$_POST['vendor_name'];

	//setup query, selects row where vendor name matches input
	$query="SELECT * FROM vendors WHERE vendor_name='$vendor_name'";

	//execute query
    $result=mysqli_query($dbconn, $query);
}?>
<!DOCTYPE html>
<html>
<head>
	<title>Lookup Vendor Form</title>
	<style>
	/* input field with search icon */
	input[type=text] {
  width: 80%;
  box-sizing: border-box;
  border: 2px solid orange;
  border-radius: 50px;
  font-size: 16px;
  background-color: white;
  background-image: url("../../img/lnt/search_icon.png");
  background-position: 15px 10px; 
  background-size: 20px;
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
}
	/*focuses/highlights box when inputting*/
	input[type=text]:focus {
  	background-color: #76E8AF;
	}
	body{
	   background-image:url('../../img/lnt/vendor_background2.gif');
      background-size:cover;
	} 
	/* centers images */
	.center {
  	display: block;
  	margin-left: auto;
    margin-right: auto;
  	width: 30%;
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
      width:60%;
      margin-left:5%;
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
	</style>
</head>
<body>
	<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG id="logo"SRC="../../img/lnt/logo.png">
  </a>
  <br>
	<IMG SRC ="../../img/lnt/Lookup-Vendors.png" class="center">
  <br>	
	<form id="form"action="search_vendor.php" method="POST" style="text-align: center">
    <IMG id="img" SRC="../../img/lnt/absol.gif" ><!-- inserts gif -->
    <h3 style="text-align: center">Insert the vendor name you wish to look up and press enter</h3>
    <h5 style="text-align: center"> Case sensitive. Ex: Silph Corporation</h5>
    <br>
			<input type="text" name="vendor_name" placeholder="Search..." required>
			<input type="submit" name="submit" hidden/> <!--keeps submit button hidden, so user can simply just press enter  -->
      
      <?php 
      if(mysqli_num_rows($result) > 0)//while it isn't empty
		{
        while($row = $result->fetch_assoc())
        {
                echo str_pad("VID:",25) . $row['VID'] . "\n";
                echo str_pad("Vendor Name:",25) . $row['vendor_name'] . "\n";
                echo str_pad("Vendor Code:",25) . $row['vendor_code'] . "\n";
                echo str_pad("Vendor City:",25) . $row['vendor_city'] . "\n";
                echo str_pad("Vendor Region:",25) . $row['vendor_region'] . "\n";
                echo str_pad("Vendor Country:",25) . $row['vendor_country'] . "\n";
                echo str_pad("Vendor Zip Code:",25) . $row['vendor_zip_code'] . "\n";
                echo str_pad("Vendor Contact Name:",25) . $row['vendor_contact_name'] . "\n";
                echo str_pad("Vendor Contact Title:",25) . $row['vendor_contact_title'] . "\n";
                echo str_pad("Vendor Contact Route:",25) . $row['vendor_contact_route'] . "\n";
                echo str_pad("Vendor Contact Number:",25) . $row['vendor_contact_number'] . "\n";
        }

    }
    else
    {
        echo "No records matching vendor name were found.";//if input doesn't match a vendor in the database
    }?>
			
	</form>
</body>
</html>
