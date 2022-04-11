<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

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
        <h1> Shopping Cart </h1>

        <form action="shopping_cart.php" method="post">
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

                    //deletes a cart item
                    function deleteRow($SCID, $IID, $dbconn)
                    {
                        $query3 = "DELETE FROM cart_item WHERE SCID = $SCID AND IID = $IID";
                        mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");
                    }

                    $query ="SELECT * FROM cart_item WHERE SCID = '$SCID'";
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
                        <td><?php echo $row['quantity'];?> 
                            <form method="post">
                                <!--adding option to change quantity-->
                                <td>
                                    <!-- enter quantity -->
                                    <label> 
                                        <input type = "number" min="0" step="1" name  = "quantity" maxlength = "10" value = "<?php echo $row['quantity']; ?>" required/>
                                    </label> 
                                
                                    <!-- save quantity -->
                                    <label>
                                        <input type="submit" name="<?php echo $currentName; ?>" value="Save"/>
                                        <?php
                                            if(isset($_POST[$currentName]))
                                            { 
                                                $quantity = $_POST['quantity'];
                                                if($quantity > 0) //update quantity in database
                                                {
                                                    $query = "UPDATE cart_item SET quantity = $quantity WHERE SCID = $SCID AND IID = $IID";
                                                    mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
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
                                        <input type="submit" name="<?php echo $currentName2; ?>" value="Delete from cart"/>
                                        <?php
                                            if(isset($_POST[$currentName2])) //update database
                                            { 
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

        <form action="checkout.php" method="post"> 
            <a href = "checkout.php">
            <h2>Checkout</h2>
            </a>
        </form>
        
    </body>
</html>