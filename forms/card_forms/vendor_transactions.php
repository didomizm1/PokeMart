<?php

//connect to database
include_once('../connect_mysql.php');

//transaction
if ($_POST['submit']) //purchase=submit
{

    //get vendor name or id ; from vendors
    $query0= "INSERT INTO `vendor_transaction` (`number_of_items`,`total_price`) SELECT `number_of_items`,`total_price` FROM 'shopping_cart'";
   
    //get Item ID, ; from innventory
    $query1= "INSERT INTO `vendor_transaction` (`IID`, `quantity`) FROM `card_item`";
    
    //get date stamp
    $query2= "INSERT INTO FROM``";
    
    //get payment method (debit, card, cash)
    $query3= "INSERT INTO";

    $result = mysqli_query($dbconn, $query0);
    $result = mysqli_query($dbconn, $query1);
    $result = mysqli_query($dbconn, $query2);
    $result = mysqli_query($dbconn, $query3);
 
}

?>

//  vendor ID (VID); from vendor (insert_vendor)
    item (ID) quantity; from iteniery 
  /*  total quantity of items purchased; //no idea
    total cost // all from the same place */
    type of transaction (debit/credit/cash) 
    date stamp //idk 
    refund/rebate/remission 