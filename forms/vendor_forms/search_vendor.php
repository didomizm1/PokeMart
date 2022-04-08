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
  $row = $result->fetch_assoc();
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
      <br><br>

      <style>
        .pad
        {
          padding-right: 28px;
        }
      </style>
      
      <?php 
            
            if(isset($_POST['submit']))
            {
              if($row != null)
              {
                echo "</br>"; 
                echo "VID:" . "<label class = 'pad'></label>" . $row['VID'];
                echo "</br>";  
                echo "Vendor Name:" . "<label class = 'pad'></label>". $row['vendor_name'];
                echo "</br>";  
                echo "Vendor Code:". "<label class = 'pad'></label>". $row['vendor_code'];
                echo "</br>";  
                echo "Vendor City:" . "<label class = 'pad'></label>". $row['vendor_city'];
                echo "</br>";  
                echo "Vendor Region:". "<label class = 'pad'></label>" . $row['vendor_region'];
                echo "</br>";  
                echo "Vendor Country:". "<label class = 'pad'></label>" . $row['vendor_country'];
                echo "</br>";  
                echo "Vendor Zip Code:". "<label class = 'pad'></label>" . $row['vendor_zip_code'];
                echo "</br>";  
                echo "Vendor Contact Name:". "<label class = 'pad'></label>" . $row['vendor_contact_name'];
                echo "</br>";  
                echo "Vendor Contact Title:". "<label class = 'pad'></label>" . $row['vendor_contact_title'];
                echo "</br>";  
                echo "Vendor Contact Route:". "<label class = 'pad'></label>" . $row['vendor_contact_route'];
                echo "</br>";  
                echo "Vendor Contact Number:". "<label class = 'pad'></label>" . $row['vendor_contact_number']; 
              }
              else
              {
                echo "No records matching vendor name were found";
              }
            }
          
    ?>
			
	</form>
</body>
</html>
