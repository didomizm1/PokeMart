<?php
    //session handling
  require_once('../employee_session.php');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reports Page</title>
  <style>
    /*background*/
    body{
      background-image:url('../../img/lnt/reports_background.gif');
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
    #z
    {
      margin-left:28%;
      margin-top:12%;
      width:20.0%;
    }
    #expenses
    {
      margin-left: 1.0%;
      margin-top:12%;
      width:30.0%;
    }
   
        
  </style>
</head>
<!--Contains the links to all the report forms-->
  <body>
    <a href = "../home_page/index.php"><!-- makes logo link to homepage -->
      <IMG id="logo" SRC="../../img/lnt/logo.png" >
  </a>
    <IMG SRC ="../../img/lnt/Reports.png" class="center" >
    <br>
    <a href="../reports/z_report.php">
       <IMG id="z" SRC ="../../img/lnt/z_report2.png" >
    </a>
     <a href="../reports/inserting_store_expenses.php">
        <IMG id="expenses" SRC="../../img/lnt/Insert-Expenses.png">
    </a>
  </body>
</html>