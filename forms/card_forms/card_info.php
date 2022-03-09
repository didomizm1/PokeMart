<?php
//use existing saved card, connect to database
if (isset($_POST['submit']))
{
    //connect w/data base 
  include_once('../connect_mysql.php');
  $card_holder_name=$_POST['card_holder_name'];
  $query = "SELECT 'card_holder_name' FROM `card_info` WHERE `card_holder_name` = $card_holder_name";
   //select existing card by name
   echo "no saved payments";
  $result = mysqli_query($dbconn, $query);
  if(mysqli_num_rows($result)>0)
   {   
     echo "'card_holder_name'";
   }
  else
  {
    echo "No saved Payments";
  }
}
?>