<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];
//get customer profile info associated with logged in user
$CPID = $_SESSION['CPID'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer Order History</title>
        <link rel = "stylesheet" href = "customer_order_history.css">

    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

        <img id = "order_history" src = "../../img/lnt/order_history.png" alt = "Order History" width ="300">

        <a href = "../profile_forms/profile_page.php">
            <img id = "back_to_profile" src = "../../img/lnt/back_to_profile.png" alt = "back to profile page" width ="300">
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

                    $query ="SELECT * FROM customer_order WHERE CPID = '$CPID'";
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
                        <td>
                        <form action="customer_order_invoice.php" method="post"> 
                            <label>
                                <input type = "hidden" name = "COID" value = "<?php echo $COID; ?>" />
                                <input type = "submit" value = "<?php echo $COID; ?>" />
                            </label>
                        </form> 
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
    </body>
</html>