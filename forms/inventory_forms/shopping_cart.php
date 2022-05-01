<?php

    //session handling
    require_once('../session.php');

    //connect to database
    include_once('../connect_mysql.php');

    //get user profile data associated with logged in user
    $SCID = $_SESSION['SCID'];

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
	    <link rel = "stylesheet" href = "shopping_cart.css">
    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

        <a href = "wishlist.php">
            <img id = "wishlist" src = "../../img/lnt/wishlist.png" alt = "Wishlist" width ="300">
        </a>

        <img id = "cart" src = "../../img/lnt/cart.png" alt = "Shopping Cart" width ="300">

        <a href = "customer_shopping.php">
            <img id = "back_to_shop" src = "../../img/lnt/back_to_shop.png" alt = "back to shop" width ="300">
        </a>
<?php
        if(isset($_SESSION['canCheckout'])) //only display link if user can check out
        {
?>
            <a href = "select_card.php">
                <img id = "checkout" src = "../../img/lnt/checkout_text.png" alt = "checkout" width ="300">
            </a>
<?php
        }
?>

        <form action="shopping_cart.php" method="post">
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>In Stock</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Change Quantity</th>
                    <th>Delete</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php

                    //deletes a cart item
                    function deleteRow($SCID, $IID, $dbconn)
                    {
                        $query3 = "DELETE FROM shopping_cart_item WHERE SCID = '$SCID' AND IID = '$IID'";
                        mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");

                        $query4 ="SELECT * FROM shopping_cart_item WHERE SCID = '$SCID'";
                        $result4 = mysqli_query($dbconn, $query4);

                        //do not allow checkout if cart is empty
                        $row4 = $result4->fetch_array(MYSQLI_ASSOC);
                        if($row4 == null)
                        {
                            unset($_SESSION['canCheckout']);
                        }

                        //reloads page
                        header("Refresh:0");
                    }

                    $query ="SELECT * FROM shopping_cart_item WHERE SCID = '$SCID'";
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
                        <td><?php echo $row2['item_name'];?></td>
                        <td><?php echo $row2['in_stock'];?></td>
                        <td><?php echo $row2['selling_price'];?></td>
                        <td><?php echo $row['quantity'];?> 
                            <form method="post">
                                <!--adding option to change quantity-->
                                <td>
                                    <!-- enter quantity -->
                                    <label> 
                                        <input type = "number" min="0" step="1" name  = "quantity" maxlength = "10" value = "<?php echo $row['quantity']; ?>" required />
                                    </label> 
                                
                                    <!-- save quantity -->
                                    <label>
                                        <input type="submit" name="<?php echo $currentName; ?>" value="Save" />
                                        <?php
                                            if(isset($_POST[$currentName]))
                                            { 
                                                $quantity = $_POST['quantity'];

                                                //update shopping cart variables
                                                $selling_price = $row2['selling_price'];
                                                $shoppingCartQuery = "UPDATE shopping_cart SET number_of_items = number_of_items + ('$quantity' - (SELECT quantity FROM shopping_cart_item WHERE SCID = '$SCID' AND IID = '$IID')), total_price = total_price + ('$selling_price' * ('$quantity' - (SELECT quantity FROM shopping_cart_item WHERE SCID = '$SCID' AND IID = '$IID'))) WHERE SCID = '$SCID'";
                                                mysqli_query($dbconn, $shoppingCartQuery) or die("Couldn't execute query\n");

                                                if($quantity > 0) //update quantity in database
                                                {
                                                    $query = "UPDATE shopping_cart_item SET quantity = '$quantity' WHERE SCID = '$SCID' AND IID = '$IID'";
                                                    mysqli_query($dbconn, $query) or die("Couldn't execute query\n");

                                                    //reloads page
                                                    header("Refresh:0");
                                                }
                                                else //delete item if quantity was set to 0
                                                {
                                                    deleteRow($SCID, $IID, $dbconn);
                                                }

                                            }
                                        ?>
                                    </label>
                                </td>

                                <!-- delete item from cart -->
                                <td>
                                    <label>
                                        <input type="submit" name="<?php echo $currentName2; ?>" value="Delete from cart" />
                                        <?php
                                            if(isset($_POST[$currentName2])) //update database
                                            { 
                                                //update shopping cart variables
                                                $selling_price = $row2['selling_price'];
                                                $shoppingCartQuery2 = "UPDATE shopping_cart SET number_of_items = number_of_items - (SELECT quantity FROM shopping_cart_item WHERE SCID = '$SCID' AND IID = '$IID'), total_price = total_price - ('$selling_price' * (SELECT quantity FROM shopping_cart_item WHERE SCID = '$SCID' AND IID = '$IID')) WHERE SCID = '$SCID'";
                                                mysqli_query($dbconn, $shoppingCartQuery2) or die("Couldn't execute query\n");

                                                //delete cart item
                                                deleteRow($SCID, $IID, $dbconn);
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