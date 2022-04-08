<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$WID = $_SESSION['WID'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Wishlist</title>
       <!-- <h1>PokéMart Store!</h1>-->
	    <link rel = "stylesheet" href = "shopping_cart.css">

    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

        <form action="wishlist.php" method="post">
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Change Quantity</th>
                    <th>Delete</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php

                    //deletes a wishlist item
                    function deleteRow($WID, $IID, $dbconn)
                    {
                        $query3 = "DELETE FROM wishlist_item WHERE WID = $WID AND IID = $IID";
                        mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");
                    }

                    $query ="SELECT * FROM wishlist_item WHERE WID = '$WID'";
                    $result = mysqli_query($dbconn, $query);

                    $count = 0;
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        //make a unique name for each iteration of the row
                        $count = $count + 1;
                        $currentName = "save" . $count;
                        $currentName2 = "delete" . $count;

                        $IID = $row['IID'];
                        $query2 = "SELECT * FROM inventory WHERE IID = '$IID'";
                        $search_result = mysqli_query($dbconn, $query2);
                        $row2 = $search_result->fetch_array(MYSQLI_ASSOC);
                ?>

                        <tr>
                        <td><?php echo $row2['IID'];?></td>
                        <td><?php echo $row2['item_name'];?></td>
                        <td><?php echo $row2['selling_price'];?></td>
                        <form method="post">

                        <!-- delete item from wishlist -->
                        <td>
                            <label>
                                <input type="submit" name="<?php echo $currentName2; ?>" value="Delete from wishlist"/>
                                <?php
                                    if(isset($_POST[$currentName2])) //update database
                                    { 
                                        deleteRow($WID, $IID, $dbconn);
                                    }
                                ?>
                            </label>
                        </td>
                        </form>
                    </td>
                    </tr>
                <?php
                    }
                ?>
            </table>
        </form>

        <div class="Checkout">
        <form action="checkout.php" method="post"> 
            <a href = "checkout.php"></a>
            <h2>Checkout</h2>
            </a>
        </form>
        </div>
        
    </body>
</html>