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
      margin-top:2.5%;
  		width: 45%;
  	}
  	/*positions each img*/
    #logo
    {
      margin-left:0.5%;
      margin-top:1%;
      width:27.25%;
    }
    #insert
    {
      margin-left:5%;
      margin-top:12%;
      width:20.0%;
    }
    #delete
    {
      margin-left: 1.0%;
      margin-top:12%;
      width:20.0%;
    }
    #lookup
    {
      margin-left: 1.0%;
      margin-top:12%;
      width:20.0%;
    }
    #update
    {
     margin-left:1.0%;
      margin-top:12%;
      width:20.0%;
    }
		

	</style>
</head>
<!--Contains the links to all the vendor forms-->
	<body>
		<a href = "../home_page/index.php"><!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png" >
  </a>
  		 <IMG SRC ="../../img/lnt/vendors.png" class="center" >
  		<a href="../vendor_forms/insert_vendor.html">
  		 <IMG id="insert" SRC ="../../img/lnt/insert.png">
  	</a><
  	<a href="../vendor_forms/delete_vendor.html">
  		 <IMG id="delete" SRC ="../../img/lnt/delete.png" >
  	</a>
  	<a href="../vendor_forms/search_vendor.html">
  		 <IMG id="lookup" SRC ="../../img/lnt/Lookup.png">
  	</a>
  	<a href="../vendor_forms/update_vendor.html">
  		 <IMG id="update" SRC ="../../img/lnt/Update.png">
  	</a>
	</body>
</html>