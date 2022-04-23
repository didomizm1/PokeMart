<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];
//get customer profile info associated with logged in user
$CPID = $_SESSION['CPID'];
//get customer order ID
$COID = $_POST['COID'];


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Order Invoice</title>
        <link rel = "stylesheet" href = "customer_order_history.css">

    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

        <img id = "order_invoice" src = "../../img/lnt/order_invoice.png" alt = "Order Invoice" width ="300">

        <form action="customer_order_invoice.php" method="post">

        <a href = "customer_order_history.php">
        <img id = "back_to_order_history" src = "../../img/lnt/back_to_order_history.png" alt = "back to order history" width ="300">
        </a>

        <table>
                <tr>
                    <th>Order Number</th>
                    <th>Items Purchased</th>
                    <th>Total</th>
                    <th>Order Date</th>
                </tr>

                <!-- populate table from mysql database -->
                <?php

                    $query = "SELECT * FROM customer_order WHERE COID = '$COID'";
                    $result = mysqli_query($dbconn, $query);
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                ?>
                    <tr>
                    <td><?php echo $row['COID'];?></td>
                    <td><?php echo $row['number_of_items'];?></td>
                    <td><?php echo $row['total_price'];?></td>
                    <td><?php echo $row['date_stamp'];?></td>
                    <form method="post">
                    </form>
                    </td>
                    </tr>
            </table>
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Item Description</th>
                    <th>Item Type</th>
                    <th>Price</th>
                   
                </tr>

                <!-- populate table from mysql database -->
                <?php

                    $query ="SELECT * FROM customer_order WHERE COID = '$COID'";
                    $result = mysqli_query($dbconn, $query);

                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        //make a unique name for each iteration of the row
                        $COID = $row['COID'];
                        $query2 = "SELECT * FROM customer_order WHERE COID = '$COID'";
                        $search_result = mysqli_query($dbconn, $query2);
                        $row2 = $search_result->fetch_array(MYSQLI_ASSOC);
                ?>

                        <tr>
                        <td><?php echo $row2['COID'];?></td>
                        <td><?php echo $row2['number_of_items'];?></td>
                        <td><?php echo $row2['total_price'];?></td>
                        <td><?php echo $row2['date_stamp'];?></td>
                        <form method="post">

                        
                        </form>
                    </td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </form>

 
    </body>
</html>