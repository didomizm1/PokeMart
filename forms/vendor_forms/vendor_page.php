<?php
    //session handling
  require_once('../employee_session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vendor Page</title>
	<style>
		/*background*/
		body{
			background-image:url('../../img/lnt/vendor_background.gif');
			background-size:cover;
		}
		/* centers images */
		.center {
  		display: block;
  		margin-left: auto;
  		margin-right: auto;
      margin-top:4%;
  		width: 30%;
  	}
  	/*positions each img*/
    #logo
    {
      margin-left:0%;
      margin-top:0%;
      width:27.25%;
    }
    #insert
    {
      margin-left:13%;
      margin-top:18%;
      width:17.0%;
    }
    #delete
    {
      margin-left: 1.0%;
      margin-top:18%;
      width:17.0%;
    }
    #lookup
    {
      margin-left: 1.0%;
      margin-top:18%;
      width:17.0%;
    }
    #update
    {
      margin-left:1.0%;
      margin-top:18%;
      width:17.0%;
    }
		

	</style>
</head>
<!--Contains the links to all the vendor forms-->
	<body>
		<a href = "../home_page/index.php"><!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png" >
  </a>
  		 <IMG SRC ="../../img/lnt/vendors.png" class="center" >
  		<a href="../vendor_forms/insert_vendor.php">
  		 <IMG id="insert" SRC ="../../img/lnt/insert.png">
  	</a><
  	<a href="../vendor_forms/delete_vendor.php">
  		 <IMG id="delete" SRC ="../../img/lnt/delete.png" >
  	</a>
  	<a href="../vendor_forms/search_vendor.php">
  		 <IMG id="lookup" SRC ="../../img/lnt/Lookup.png">
  	</a>
  	<a href="../vendor_forms/update_vendor.php">
  		 <IMG id="update" SRC ="../../img/lnt/Update.png">
  	</a>
	</body>
</html>