<?php
   //connect w/data base 
 echo "No saved Payments";
  
if (isset($_POST['submit']))
{
  include_once('../connect_mysql.php');
  $card_holder_name=$_POST['card_holder_name'];
  $query = "SELECT 'card_holder_name' FROM `card_info` WHERE `card_holder_name` = $card_holder_name";
   //select existing card by name
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