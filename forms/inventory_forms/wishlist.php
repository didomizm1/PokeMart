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
	    <link rel = "stylesheet" href = "wishlist.css">
        

    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

        <img id = "wishlist" src = "../../img/lnt/wishlist.png" alt = "Wishlist" width ="300">

        <a href = "shopping_cart.php">
        <img id = "cart" src = "../../img/lnt/cart.png" alt = "Shopping Cart" width ="300">
        </a>

        <a href = "customer_shopping.php">
        <img id = "back_to_shop" src = "../../img/lnt/back_to_shop.png" alt = "back to shop" width ="300">
        </a>

        <form action="wishlist.php" method="post">
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>In Stock</th>
                    <th>Price</th>
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
                        $currentName = "delete" . $count;

                        $IID = $row['IID'];
                        $query2 = "SELECT * FROM inventory WHERE IID = '$IID'";
                        $search_result = mysqli_query($dbconn, $query2);
                        $row2 = $search_result->fetch_array(MYSQLI_ASSOC);
                ?>

                        <tr>
                        <td><?php echo $row2['item_name'];?></td>
                        <td><?php echo $row2['in_stock'];?></td>
                        <td><?php echo $row2['selling_price'];?></td>
                        <form method="post">

                        <!-- delete item from wishlist -->
                        <td>
                            <label>
                                <input type="submit" name="<?php echo $currentName; ?>" value="Delete from wishlist"/>
                                <?php
                                    if(isset($_POST[$currentName])) //update database
                                    { 
                                        //get current date
                                        date_default_timezone_set("America/New_York");
                                        $date = date("Y-m-d H:i:s");

                                        //update wishlist variables
                                        $wishlistQuery = "UPDATE wishlist SET last_updated = '$date', number_of_items = number_of_items - 1 WHERE WID = '$WID'";
                                        mysqli_query($dbconn, $wishlistQuery) or die("Couldn't execute query\n");

                                        //delete wishlist item
                                        deleteRow($WID, $IID, $dbconn);

                                        //reloads page
                                        header("Refresh:0");
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
    </body>
</html>