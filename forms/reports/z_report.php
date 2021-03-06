<?php
//Maranda Dominguez
  //session handling, only employees can access
  require_once('../employee_session.php');

?>
<!DOCTYPE html>
<html>
<head>
	<title>Z-Report</title>
</head>
<style>
	/* centers images */
	.center 
  {
  	display: block;
  	margin-left: auto;
  	margin-right: auto;
  	width: 25%;
	}
	/*submit button*/
	input[type=submit] 
  {
    background-color: #FFA500;
    border: none;
    border-radius:50px;
    color: white;
    padding: 10px 32px;
    text-decoration: none;
    margin: 1px 1px;
    cursor: pointer;
  }
  /* input border */
  input[type=date] 
  {
    width: 20%;
    padding: 10px 18px;
    margin: 8px 0;
    margin-top:18%;
    box-sizing: border-box;
    border: 2px solid orange;
    border-radius:50px;
  }
  /*focuses/highlights box when inputting*/
  input[type=date]:focus 
  {
    background-color: #efbf67;
  }
  /*sets background*/
  body
  {
    background-image:url('../../img/lnt/z_report_background.gif');
    background-size:cover;
  } 
  /*positions logo*/
  #logo
  {
    margin-left:0%;
    margin-top:0%;
    width:27.25%;
  }
</style>
<body>
	<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png">
  </a>
	<IMG SRC ="../../img/lnt/z_report2.png" class="center">
	<h2 style="text-align: center">Enter a date, then press submit to get the Z-Report for that day</h2>
	<form action="display_z_report.php" method="POST" style="text-align: center">
			Date: <input type="date" name="date" required>
			<br><br>
			<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>