<?php
//use existing saved card, connect to database

if (isset($_POST ['use_this_payment_method']))
{
//connect w/data base 
    include_once('../connect_mysql.php'); //how to connect w/database?
    //select existing card
    $query = " SELECT `card_name` FROM `card_info`
    WHERE `card_name` = '".$_POST['card_name']."'";
}
//add card, 
elseif (isset($_POST['add_payment']))
{
 //   $query10 ="INSERT INTO `card_info` (`card_holder_name`, `card_number`, `cvv`, `month`, `year`) 
 //   VALUES ('".$_POST['card_holder_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['card_year']."')"; 
    //card holder full name

    //card number (16 digits)
       $query1 =  
    //month

    //year 

    //cvv

//save card
    if ($_POST['save_card'])
    {
        //save to database
        $query10 ="INSERT INTO `card_info` (`card_holder_name`, `card_number`, `cvv`, `month`, `year`) 
        VALUES ('".$_POST['card_holder_name']."','".$_POST['card_number']."','".$_POST['cvv']."','".$_POST['month']."','".$_POST['card_year']."')"; 
        //name the card 
    }
}

   



