<?php
//connect w/data base 
 include_once('connection.php');
 
 //use existing saved card, connect to database
if (isset($_POST['save_card']))
{
    //select existing card by name
    $query = " SELECT `card_holder_name` FROM `card_info`
    WHERE `card_holder_name` = '".$_POST['card_holder_name']."'";
    $result = mysqli_query($dbconn, $query);
    if(mysqli_num_rows($result))
    {   
    echo($result);
    }
}
else
{
    echo("No saved Payments");
}
//add card, 
if ($_POST['save_card'])
{
     //save to database
    $query10 ="INSERT INTO `card_info` (`card_holder_name`, `card_number`, `cvv`, `month`, `year`,`street_add_1`,`street_add_2`,`city`,`zip_code`) 
    VALUES ('".$_POST['card_holder_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['year']."','".$_POST['street_add_1']."',
    '".$_POST['street_add_2']."','".$_POST['city']."','".$_POST['zip_code']."')"; 
}
?>