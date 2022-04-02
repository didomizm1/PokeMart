<?php

//connect to database
include_once('../connect_mysql.php');

//transaction
if ($_POST['submit']) //purchase=submit
{
    //get numeber of total items & total price & customer ID; shopping cart ;
    $query0= "INSERT INTO `customer_transaction` (`number_of_items`,`total_price`) SELECT `number_of_items`,`total_price` FROM 'shopping_cart'";
    
    //get Item ID, quanitty  ; from cart item
    $query1= "INSERT INTO `customer_transaction` (`IID`, `quantity`) FROM `card_item`";
   
    //get date stamp
    $query2= "INSERT INTO `customer_transaction`(`trans_date`) FROM `//time stamp`";
   
    //get payment method (debit, card, cash)
    $query3= "INSERT INTO `customer_transaction` (`tran_type`) FROM `tran_type`";

    $result = mysqli_query($dbconn, $query0);
    $result = mysqli_query($dbconn, $query1);
    $result = mysqli_query($dbconn, $query2);
    $result = mysqli_query($dbconn, $query3);
   
}

?>
//what is SCID
//  customer id; from (CPID)
    item (product ID) and quantity; from inventory(IID)
    total quantity of items purchased; from (cart item)
    total cost; from (shopping cart)
    type of transaction (debit/credit/cash); from transaction type  //need to make
    date stamp //idk 
    refunds/rebate/remission ;// also needs to be done 
