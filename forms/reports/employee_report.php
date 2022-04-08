<?php
require_once('../employee_session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lookup Z-Report</title>
</head>
<style>

	/*submit button*/
	input[type=submit] {
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
input[type=number],input[type=date] {
  width: 20%;
  padding: 10px 18px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid orange;
  border-radius:50px;
}
input[type=number]
{
	margin-top:14%;
}
/*focuses/highlights box when inputting*/
input[type=number]:focus,input[type=date]:focus {
  background-color: #efbf67;
}
body{
	background-image:url('../../img/lnt/z_report_background.gif');
      background-size:cover;
} 
/*scales*/
	#lookup
    {
      margin-left: 30.0%;
      margin-top:2%;
      width:20.0%;
    }
    #report
    {
   	  margin-left: 1.0%;
      margin-top:2%;
      width:22.0%;

    }
    #logo
    {
      margin-left:0.5%;
      margin-top:1%;
       width:27.25%;
    }

</style>
<body>
	<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png">
  </a>
  <br>
	<IMG id="lookup" SRC ="../../img/lnt/Lookup.png">
	<IMG id="report" SRC ="../../img/lnt/z_report2.png">
	<br>	
	<h3 style="text-align: center">Type in employee ID and date, then press submit to get their Z-Report for that day</h3>
	<form action="display_employee_report.php" method="POST" style="text-align: center">
			EPID: <input type="number" value="EPID" name="EPID" required>
			<br>
			Date: <input type="date" name="date" required>
			<br><br>
			<input type="submit" name="submit" value="Submit">
	</form>
</html>
