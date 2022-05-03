<?php
//Maranda Dominguez
  //protects file, only employees can acesss
  require_once('../employee_session.php');

  //connect to database
  include_once('../connect_mysql.php');
  if(isset($_POST['submit']))
  {
    //variables
    $month=$_POST['month'];
    $year=$_POST['year'];
    $expense=$_POST['expense'];
    $cost=$_POST['cost'] ;
    //checking if row exists with submitted month and year
    $query1="SELECT * FROM store_expense WHERE month='$month' AND year='$year'";
    $result=mysqli_query($dbconn,$query1);
    if(mysqli_num_rows($result)==0)//if row doesn't exist
    {
      //query to insert, month,year and expense 
      $query="INSERT INTO store_expense (month,year,$expense) VALUES('$month','$year','$cost')";
    }
    else
    {
      //setup query, adds the cost to the specific cell depending on month, year and type of expense
      $query="UPDATE store_expense SET $expense=$expense+'$cost' WHERE month='$month' AND year='$year'";
    }
  }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Store Expenses</title>
</head>
<style>
	/* centers images */
	.center 
  {
  	display: block;
  	margin-left: auto;
  	margin-right: auto;
  	width: 30%;
	}
	/*submit button*/
	input[type=submit] 
  {
    background-color: #3366ff;
    border: none;
    border-radius:50px;
    color: white;
    padding: 10px 32px;
    text-decoration: none;
    margin-left:30%;
    cursor: pointer;
  }
  /* input border */
  input[type=text],input[type=number],select 
  {
    margin:12px 0;
    border: 2px solid orange;
    border-radius: 50px;
    width:60%;
  }

  /*focuses/highlights box when inputting*/
  input[type=text]:focus,input[type=number]:focus,select:focus 
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
	<IMG SRC ="../../img/lnt/Store-Expenses.png" class="center" >
	<br>
	<form id="form"action="inserting_store_expenses.php" method="POST">
    <h2 style="text-align: center">Enter the month/year, and any expense used towards the store</h2>
    <br>
    Month: <input type="text" name="month" placeholder="04" required>
    <br>
    Year:<input type="text"  name="year" placeholder= "2022" required>
    <br>
    <label for="expense">Expense for:</label>
    <!-- expenses selection -->
    <select id="expense" name="expense" required>
      <option value="utilities">Utilities</option>
      <option value="rent">Rent</option>
      <option value="other_expenses">Other</option> 
    </select>
    <br>
    Cost:<input type="number" step="0.01" name="cost"  required>
    <br>
    <input type="submit" name="submit" value="Submit">
    <br><br>
    <?php
      if(isset($_POST['submit']))
      {
        //execute query
        if($dbconn->query($query)==TRUE)
        {
          echo nl2br("Expense added successfully\n");
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