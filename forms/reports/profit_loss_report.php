<?php
//Maranda Dominguez
  //session handling, only employees can access this page
  require_once('../employee_session.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Profit-Loss Report</title>
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
  input[type=text] 
  {
    width: 40%;
    padding: 10px 18px;
    margin: 8px 0;
    margin-top:18%;
    box-sizing: border-box;
    border: 2px solid orange;
    border-radius:50px;
  }
  /*focuses/highlights box when inputting*/
  input[type=text]:focus 
  {
    background-color: #efbf67;
  }
  /*sets background*/
  body
  {
    background-image:url('../../img/lnt/expenses.gif');
    background-size:cover;
  }
  /*positions logo*/
  #logo
  {
    margin-left:0%;
    margin-top:0%;
    width:27.25%;
  }
   /*puts form into box*/
  #form
  {  
    background: rgb(255, 153, 153);
    border: solid rgb(34, 172, 226) 25px;  
    border-radius: 50px;   
    margin-left: auto;
    margin-right: auto;   
    padding: 70px;  
    width: 25%; 
  }     
</style>
<body>
	<a href = "../home_page/index.php"> <!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png">
  </a>
	<IMG SRC ="../../img/lnt/ProfitLoss-.png" class="center" >
	
	<form id="form" action="display_profit_loss_report.php" method="POST" style="text-align: center">
      <h2 style="text-align: center">Enter a month and year for the report:</h2>
			Month: <input type="text" name="month" placeholder="04" required>
			<br>
      Year: <input type="text" name="year" placeholder="2022" required>
      <br><br>
			<input type="submit" name="submit" value="Submit">
	</form>
</body>
</html>