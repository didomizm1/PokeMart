<?php

//connect to database
include_once('../connect_mysql.php');
//transaction
if ($_POST['submit']) //purchase=submit
{

    //get numeber of total items & total price ; shopping cart
    $query0="INSERT INTO `custumer_transaction` (`number_of_items`,`total_price`) SELECT `number_of_items`,`total_price` FROM 'shopping_cart'";
    //get Item ID, quanitty  ; from cart item
    $query1="INSERT INTO `custumer_transaction` (`IID`, `quantity`) FROM `card_item`";
    //get date stamp
    $query2="INSERT INTO FROM``";
    //get payment method (debit, card, cash)
    $query3="INSERT INTO";

    $result = mysqli_query($dbconn, $query0);
    $result = mysqli_query($dbconn, $query1);
    $result = mysqli_query($dbconn, $query2);
    $result = mysqli_query($dbconn, $query3);

   
}

?>
//what is SCID