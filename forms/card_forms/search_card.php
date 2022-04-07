<?php
   //connect w/data base 

if ($_POST['submit'])
{
  //check if data has been added
  include_once('../connect_mysql.php');

//  $card_holder_name=$_POST['card_holder_name'];

//select existing card by name
  $query = "SELECT 'card_holder_name' FROM `card_info` WHERE `card_holder_name` = '".$_POST['card_holder_name']."'";
  $result = mysqli_query($dbconn, $query);
  if(mysqli_num_rows($result))
  {
    echo "<table>";
    echo "<tr>";
        echo "<th>Card Holder Name</th>";
        echo "<th>Card Numeber</th>";
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
        echo "No records matching vendor name were found.";
    }

 }
?>