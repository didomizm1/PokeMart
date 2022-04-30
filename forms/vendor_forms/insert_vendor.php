<?php
  require_once('../employee_session.php');
  if(isset($_POST['submit']))
  {
    //connect to database
    include_once('../connect_mysql.php');

    //setup query;insert into vendors table
    $query="INSERT INTO `vendors` (`vendor_name`, `vendor_code`, `vendor_city`, `vendor_region`, `vendor_country`, `vendor_zip_code`, `vendor_contact_name`, `vendor_contact_title`, `vendor_contact_route`, `vendor_contact_number`) VALUES ('".$_POST['vendor_name']."','".$_POST['vendor_code']."','".$_POST['vendor_city']."','".$_POST['vendor_region']."','".$_POST['vendor_country']."','".$_POST['vendor_zip_code']."','".$_POST['vendor_contact_name']."','".$_POST['vendor_contact_title']."', '".$_POST['vendor_contact_route']."','".$_POST['vendor_contact_number']."')";

  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert New Vendor Form</title>
	<style> 
    /* input border */
    input[type=text],input[type=number] 
    {
      margin: 8px 0;
      border: 2px solid orange;
      border-radius: 50px;
      width:40%;
    }
    /*focuses/highlights box when inputting*/
    input[type=text]:focus 
    {
      background-color: #76E8AF;
    }
    /* Insert button */
    input[type=submit] 
    {
      background-color: #FF0000;
      border: none;
      border-radius:50px;
      color: white;
      padding: 10px 32px;
      text-decoration: none;
      margin-left: 30%;
      cursor: pointer;
    }
    body
    {
      background-image:url('../../img/lnt/vendor_background2.gif');
      background-size:cover;
    } 
    /* centers */
    .center 
    {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 30%;
    }
    /*scales pokemon gif*/
    #img
    {
      width:60%;
      margin: 12px 0;
    }
    /*scales logo*/
    #logo
    {
      margin-left:0%;
      margin-top:0%;
      width:27.25%;
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
      <IMG id="logo" SRC="../../img/lnt/logo.png">
  </a>
  <br>
  <IMG SRC ="../../img/lnt/Insert-Vendors.png" class="center">
  <br>
	<form id="form"action="insert_vendor.php" method="POST">
    <IMG id="img"SRC="../../img/lnt/charizard.gif" ><!-- inserts gif -->
    <h3 style="text-align: center">Insert the following vendor data and click "Insert" when done</h3><br>
		* Vendor Name: <input type="text" name="vendor_name" required>
		<br><br>
		* Vendor Code: <input type="text" name="vendor_code" required>
		<br><br>
		* Vendor City: <input type="text" name="vendor_city" required>
		<br><br>
		* Vendor Region: <input type="text" name="vendor_region" required>
		<br><br>
		* Vendor Country: <input type="text" name="vendor_country" required>
		<br><br>
		* Vendor Zip Code: <input type="text" name="vendor_zip_code" required>
		<br><br>
		Vendor Contact Name: <input type="text" name="vendor_contact_name">
		<br><br>
		Vendor Contact Title: <input type="text" name="vendor_contact_title">
		<br><br>
		 Vendor Contact Route: <input type="number" value="vendor_contact_route" name="vendor_contact_route">
		<br><br>
		* Vendor Contact Number: <input type="text" name="vendor_contact_number" required>
		<br><br>
		<input type="submit" value="Insert" name="submit">
    <br><br><br>
    <?php
      if(isset($_POST['submit']))
      {
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
	</form>
</body>
</html>

