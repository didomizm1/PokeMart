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
    $query2= "INSERT INTO `customer_transaction`(`trans_date`) FROM `**//time stamp`";
   
    //get payment method (debit, card, cash)
    $query3= "INSERT INTO `customer_transaction` (`tran_type`) FROM `tran_type`";

    $result0 = mysqli_query($dbconn, $query0);
    $result1 = mysqli_query($dbconn, $query1);
    $result2 = mysqli_query($dbconn, $query2);
    $result3 = mysqli_query($dbconn, $query3);

    if(mysqli_num_rows($result) > 0)
    {
    echo "<table>";
        echo "<tr>";
            echo "<th>Customer Order ID</th>";
            echo "<th>Customer Profile ID</th>";
            echo "<th>Number Of Items</th>";
            echo "<th>Total Cost</th>";
            echo "<th>Data Stamp</th>";
            echo "<th>Transaction type</th>";
        echo "</tr>";
    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
            echo "<td>" . $row['COID'] . "</td>";
            echo "<td>" . $row['CPID'] . "</td>";
            echo "<td>" . $row['total_quantity'] . "</td>";
            echo "<td>" . $row['total_cost'] . "</td>";
            echo "<td>" . $row['date_stamp'] . "</td>";
            echo "<td>" . $row['transaction_type'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
}
else
{
    echo "No transaction was found.";
}
}

?>
   // refunds/rebate/remission ;//
