<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
session_start();

//save search in the session
if(!(isset($_SESSION['inventory_search'])) || isset($_POST['submit']))
{
    if(isset($_POST['submit']))
    {
        $_SESSION['inventory_search'] = $_POST['valueToSearch'];
    }
    else
    {
        $_SESSION['inventory_search'] = "";
    }
}
$valueToSearch = $_SESSION['inventory_search'];

//search in all table columns using concat mysql function in order to filter inventory table
$query = "SELECT * FROM `inventory` WHERE CONCAT(`IID`, `item_name`, `japanese_item_name`, `selling_price`) LIKE '%".$valueToSearch."%'";
$result = mysqli_query($dbconn, $query);

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer Shopping</title>
       <!-- <h1>PokéMart Store!</h1> -->

	    <link rel = "stylesheet" href = "customer_shopping.css">
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart"> 
        </a>


        <a href = "wishlist.php">
        <img id = "wishlist" src = "../../img/lnt/wishlist.png" alt = "Wishlist" width ="300">
        </a>


        <a href = "shopping_cart.php">
        <img id = "cart" src = "../../img/lnt/cart.png" alt = "Shopping Cart" width ="300">
        </a>


    </head>

    <body>

    <?php    
        if(isset($_SESSION['ULID'])) //make sure a user is logged in
        {
    ?>
    <?php
        }
    ?>
           
        <form id = "form" method="post">

         
            <div id = "search">
                <input type="text" name="valueToSearch" placeholder="Search"/><br><br>
                <input type="submit" name="submit" value="Filter"/><br><br>
            </div>

            
            
            <table>
                <tr>
                    <th>Item Name</th>
                    <th>Japanese Item Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Price</th>
                    <?php    
                        if(isset($_SESSION['ULID'])) //make sure a user is logged in
                        {
                    ?>
                            <th>Quantity</th>
                    <?php
                        }
                    ?>
                </tr>
        </form>
      <!-- populate table from mysql database -->
                <?php
                include_once('customer_shopping.php'); 
                $count = 0;
                while($row = mysqli_fetch_array($result)):

                    //make a unique name for each iteration of the row
                    $count = $count + 1;
                    $currentName = "addToCart" . $count;
                    $currentName2 = "addToWishlist" . $count;
                ?>
                <tr>
                    <td><?php echo $row['item_name'];?></td>
                    <td><?php echo $row['japanese_item_name'];?></td>
                    <td><?php echo $row['item_type'];?></td>
                    <td><?php echo $row['item_description'];?></td>
                    <td><?php echo $row['selling_price'];?></td>

                <?php    
                    if(isset($_SESSION['ULID'])) //make sure a user is logged in
                    {
                ?>
                        <form method="post">
                        
                            <!--adding option to change quantity-->
                            <td>
                                <!-- enter quantity -->
                                <label> 
                                    <input type = "number" min="1" step="1" name  = "quantity" maxlength = "10" required/>
                                </label> 
                            </td>
                            
                            <!-- add item to cart -->
                            <td>
                                <label>
                                    <input type="submit" name="<?php echo $currentName; ?>" value="Add to Cart"/>
                                    <?php
                                        if(isset($_POST[$currentName])) //add to database
                                        { 
                                            $SCID = $_SESSION['SCID'];
                                            $IID = $row['IID'];
                                            $quantity = $_POST['quantity'];

                                            //fetch the stock of an item
                                            $inventoryQuery = "SELECT in_stock FROM inventory WHERE IID = '$IID'";
                                            $inventoryResult = mysqli_query($dbconn, $inventoryQuery) or die("Couldn't execute query\n");
                                            $inventoryRow = $inventoryResult->fetch_array(MYSQLI_ASSOC);

                                            if($inventoryRow['in_stock'] != 0) //check for item in stock
                                            {
                                                if($inventoryRow['in_stock'] - $quantity >= 0) //ensure quantity can be fulfilled by given stock
                                                {
                                                    //check if item exists in the cart
                                                    $query2 ="SELECT * FROM shopping_cart_item WHERE SCID = '$SCID' AND IID = '$IID'";
                                                    $result2 = mysqli_query($dbconn, $query2);
                                                    $row2 = $result2->fetch_array(MYSQLI_ASSOC);

                                                    if($row2 == null) //item does not already exist in the cart
                                                    {
                                                        $query3 = "INSERT INTO shopping_cart_item (IID, SCID, quantity) VALUES ('$IID', '$SCID', '$quantity')";
                                                        mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");
                                                    }
                                                    else //item does exist in the cart, so increment quantity instead
                                                    {
                                                        $incrementedQuantity = $quantity + $row2['quantity'];
                                                        $query3 = "UPDATE shopping_cart_item SET quantity = '$incrementedQuantity' WHERE SCID = '$SCID' AND IID = '$IID'";
                                                        mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");
                                                    }

                                                    //update shopping cart variables
                                                    $selling_price = $row['selling_price'];
                                                    $shoppingCartQuery = "UPDATE shopping_cart SET number_of_items = number_of_items + $quantity, total_price = total_price + ($selling_price * $quantity) WHERE SCID = '$SCID'";
                                                    mysqli_query($dbconn, $shoppingCartQuery) or die("Couldn't execute query\n");
                                                }
                                                else
                                                {
                                                    echo "<script type='text/javascript'>alert('Selected quantity is too high.');</script>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<script type='text/javascript'>alert('Item is out of stock.');</script>";
                                            }
                                            
                                        }
                                    ?>
                                </label>
                            </td>

                            <!-- add item to wishlist -->
                            <td>
                                <label>
                                    <input type="submit" name="<?php echo $currentName2; ?>" value="Add to Wishlist"/>
                                    <?php
                                        if(isset($_POST[$currentName2])) //add to database
                                        { 
                                            //get current date
                                            date_default_timezone_set("America/New_York");
			                                $date = date("Y-m-d H:i:s");

                                            //insert new wishlist item
                                            $WID = $_SESSION['WID'];
                                            $IID = $row['IID'];
                                            $query4 = "INSERT INTO wishlist_item (IID, WID, date_added) VALUES ('$IID', '$WID', '$date')";
                                            mysqli_query($dbconn, $query4) or die("Couldn't execute query\n");

                                            //update wishlist variables
                                            $wishlistQuery = "UPDATE wishlist SET last_updated = $date, number_of_items = number_of_items + 1 WHERE WID = '$WID'";
                                            mysqli_query($dbconn, $wishlistQuery) or die("Couldn't execute query\n");
                                        }
                                    ?>
                                </label>
                            </td>
                        </form>
                <?php
                    }
                ?>
                    </td>
                </tr>
                <?php endwhile;?>
            </table>
        
    </body>
</html>