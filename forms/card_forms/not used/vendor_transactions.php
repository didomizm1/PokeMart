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

    if(mysqli_num_rows($result) > 0)
    {
    echo "<table>";
        echo "<tr>";
            echo "<th>Vendor Transaction ID</th>";
            echo "<th>Vendor Order ID</th>";
            echo "<th>Number Of Items</th>";
            echo "<th>Total Cost</th>";
            echo "<th>Data Stamp</th>";
        echo "</tr>";
    while($row = $result->fetch_assoc())
    {
        echo "<tr>";
            echo "<td>" . $row['VTID'] . "</td>";
            echo "<td>" . $row['VOID'] . "</td>";
            echo "<td>" . $row['total_quantity'] . "</td>";
            echo "<td>" . $row['total_cost'] . "</td>";
            echo "<td>" . $row['date_stamp'] . "</td>";
        
        echo "</tr>";
    }

    echo "</table>";
} 
}

?>
    refund/rebate/remission 