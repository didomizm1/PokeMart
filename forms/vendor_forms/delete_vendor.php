<?php

//session handling
require_once('../employee_session.php');

//connect to database
include_once('../connect_mysql.php');

?>

<!DOCTYPE html>
<html>
<head>
	<title>Delete Vendor Form</title>
	<!-- delete confirmation -->
	<script>
	function clicked(e)
		{
    		if(!confirm('Are you sure you want to delete vendor?'))
			{
        		e.preventDefault();
    		}
		}
}	
	</script>
	<style>
	/* input border */
	input select {
  	 margin: 8px 0;
    border: 2px solid orange;
    border-radius: 50px;
    width:40%;
	}
	/*focuses/highlights box when inputting*/
	input select:focus {
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
	<form id="form" action="delete_vendor.php"  method="POST">
		<IMG id="img" SRC="../../img/lnt/snorlax.gif" ><!-- inserts gif -->
		<h3 style="text-align: center">Insert the vendor name and click "Delete" when done</h3>
		<h5 style="text-align: center">Caution: this will permanently delete the vendor from the database</h5><br>
		<!-- vendor name needed in order to delete vendor -->
	
		<label for="vendor_name"> * Vendor Name:</label>
		<select id="vendor_name" name="vendor_name">
			<?php
			//dropdown for vendor name
				$query2="SELECT vendor_name FROM vendors";
				$result=mysqli_query($dbconn, $query2);
				while ($row = $result->fetch_assoc()){
					$currentName = $row['vendor_name'];
					echo "<option value=\"$currentName\">" . $currentName . "</option>";
				}	
					
			?>
		</select>
		<select id="vendor">
		</select>
			<br><br>
			<input type="submit" value="Delete" name="submit" onclick="clicked(event)">
			<br><br><br>
			<?php
    		if(isset($_POST['submit']))
    		{
				//variables that hold vendor data inserted from html form
				$vendor_name=$_POST['vendor_name'];
				//query setup to delete vendor where vendor name,code and id match
				$query="DELETE FROM vendors WHERE vendor_name='$vendor_name'";
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
	</form>
</body>
</html>
