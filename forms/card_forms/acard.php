<?php
//connect w/data base 
  include_once('../connect_mysql.php');
 
//add card, 
if ($_POST['submit'])
{
     //save to database
    $query ="INSERT INTO `card_info` (`card_holder_name`, `card_number`, `cvv`, `month`, `year`,`street_add_1`,`street_add_2`,`city`,`zip_code`) VALUES ('".$_POST['card_holder_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['year']."','".$_POST['street_add_1']."','".$_POST['street_add_2']."','".$_POST['city']."','".$_POST['zip_code']."')"; 
    $result = mysqli_query($dbconn, $query);
	if($dbconn->query($query)==TRUE)
    {
        echo "Card Saved";
    }
    else
    {
        echo "Error";
    }
}
?>