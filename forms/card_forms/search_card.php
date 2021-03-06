<?php
  //session handling
  require_once('../session.php');

  //connect with database
  include_once('../connect_mysql.php');

  //select existing card by name
  $query = "SELECT * FROM `card_info` WHERE `CPID` = '".$_SESSION['CPID']."'";
  $result = mysqli_query($dbconn, $query);

  //if there are saved payments then they will be shown
  if(mysqli_num_rows($result))
  {
    echo "<table>";
    echo "<tr>";
      echo "<th>Card Holder Name</th>";
      echo "<th>Card Number</th>";
    echo "</tr>";
    while($row = $result->fetch_assoc())
    {
      echo "<tr>";
          echo "<td>" . $row['card_holder_name'] . "</td>";
          echo "<td>" . $row['card_number'] . "</td>";
      echo "</tr>";
    }
    echo "</table>";
  }
  else
  {
      echo "No saved payments were found.";
  }
?>