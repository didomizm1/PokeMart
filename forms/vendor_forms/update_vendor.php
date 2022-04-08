<?php
require_once('../employee_session.php');
if(isset($_POST['submit']))
{
	//connect to database
	include_once('../connect_mysql.php');

	$vendor_name=$_POST['vendor_name'];
	$info=$_POST['info'];
	$update=$_POST['update'];

	//setup query to update specific data for a vendor
	$query="UPDATE vendors SET $info='$update' WHERE vendor_name='$vendor_name'";

	
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Update Vendor Form</title>
	<style>
	/* input border */
	input[type=text],input[type=number],select {
  	margin: 8px 0;
    border: 2px solid orange;
    border-radius: 50px;
    width:40%;
	}
	/*focuses/highlights box when inputting*/
	input[type=text]:focus ,select:focus{
  	background-color: #76E8AF;
	}
	/* Update button */
	input[type=submit] {
 	 background-color: #FF0000;
  	border: none;
  	border-radius:50px;
  	color: white;
  	padding: 10px 32px;
  	text-decoration: none;
  	margin: 1px 1px;
  	cursor: pointer;
	}
  /*background*/
	body{
	background-image:url('../../img/lnt/vendor_background2.gif');
      background-size:cover;
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
/*changes link color (unvisited and visited)*/
	a:link {
  	color: red; 
  	background-color: transparent; 
  	text-decoration: none;
}

	a:visited {
  	color: blue;
  	background-color: transparent;
  	text-decoration: none;
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
  width:40%;
  margin-left:30%;
}

</style>
</head>
<body>
	<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png">
  </a>
  <br>
  <IMG SRC ="../../img/lnt/Update-Vendors.png" class="center">
	
	<br><br><br>
	<form id="form"action="update_vendor.php" method="POST">
    <IMG id="img"SRC="../../img/lnt/lucario.gif" ><!-- inserts gif -->
    <br>
    <h4 style="text-align:center">Insert the vendor name you wish to update, the corresponding information you want to update, the updated information and click "Update" when done</h4>
  <h5 style="text-align:center">Press the link below to lookup vendor information</h5>
  <a href="../vendor_forms/search_vendor.php"><p style="text-align:center">Lookup vendor</a> <!-- link to lookup vendor form -->
    <br><br>
		<label for="vendor_name"> * Vendor Name:</label>
		<select id="vendor_name" name="vendor_name">
			<?php
			//dropdown for vendor name
				$query2="SELECT vendor_name FROM vendors";
				$result=mysqli_query($dbconn, $query);
				while ($row = $result->fetch_assoc()){

					?>
					
					<option value="vendor_name"><?php echo $row['vendor_name']; ?></option>
					
					<?php
					// close while loop 
					}
					?>

		</select>
		<label for="info"> * Information to be updated:</label>
		<!-- vendor info selection -->
		<select id="info" name="info">
    		<option value="vendor_name">Vendor name</option>
    		<option value="vendor_code">Vendor code</option>
    		<option value="vendor_city">Vendor city</option>
    		<option value="vendor_region">Vendor region</option>
   			<option value="vendor_country">Vendor country</option>
   			<option value="vendor_zip_code">Vendor zip code</option>
 			<option value="vendor_contact_name">Vendor contact name</option>
 			<option value="vendor_contact_title">Vendor contact title</option>
 			<option value="vendor_contact_route">Vendor contact route</option>
 			<option value="vendor_contact_number">Vendor contact number</option>	
  		</select>
		<br>
		* Updated Information: <input type="text" name="update" required>
		<br><br>
		<input type="submit" value="Update" name="submit">
		<br><br><br>
		<?php
    	if(isset($_POST['submit']))
    	{
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
	</form>
</body>
</html>

