<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$WID = $_SESSION['WID'];


if(isset($_POST['submit']))
{
    $query ="SELECT * FROM wishlist_item WHERE WID = '$WID'";
    $result = mysqli_query($dbconn, $query);
    while($row = $result->fetch_array(MYSQLI_ASSOC))
    {
        $IID = $row['IID'];
        $query2 = "SELECT * FROM inventory WHERE IID = '$IID'";
        $search_result = mysqli_query($dbconn, $query2);
        $row2 = $search_result->fetch_array(MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Wishlist Test</title>
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
                </tr>

      <!-- populate table from mysql database -->
        
         <?php
                if(isset($_POST['submit']))
                {
                    $query ="SELECT * FROM wishlist_item WHERE WID = '$WID'";
                    $result = mysqli_query($dbconn, $query);
                    while($row = $result->fetch_array(MYSQLI_ASSOC))
                    {
                        $IID = $row['IID'];
                        $query2 = "SELECT * FROM inventory WHERE IID = '$IID'";
                        $search_result = mysqli_query($dbconn, $query2);
                        $row2 = $search_result->fetch_array(MYSQLI_ASSOC);
                        ?>

                    <tr>
                    <td><?php echo $row2['IID'];?></td>
                    <td><?php echo $row2['item_name'];?></td>
                    <td><?php echo $row2['selling_price'];?></td>
                    <td><?php echo $row2['quantity'];?> 
                    <form action="shopping_cart.php" method="post">
                    
                        <!--adding option to change quantity-->
                        <td>
                        <label> 
                        <input type = "number" min="0" step="1" name  = "quantity" maxlength = "10" required/>
                        </label> 
                        </td>
                        
                        <td>
                        <input type="submit" name="<?php echo $currentName; ?>" value="Add to Cart">
                        <?php
                            if(isset($_POST[$currentName]))
                            { 
                                $SCID = $_SESSION['SCID'];
                                $IID = $row['IID'];
                                $quantity = $_POST['quantity'];
                                $query = "INSERT INTO cart_item (IID, SCID, quantity) VALUES ('$IID', '$SCID', '$quantity')";
                                mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
                            }
                        ?>
                    </td>
                    <td>
                    <input type="submit" name="<?php echo $currentName; ?>" value="Delete from Wishlist">
                    <?php
                        if(isset($_POST[$currentName]))
                        { 
                            $SCID = $_SESSION['SCID'];
                            $IID = $row['IID'];
                            $quantity = $_POST['quantity'];
                            $query = "DELETE FROM wishlist_item (IID, SCID, quantity) VALUES ('$IID', '$SCID', '$quantity')";
                            mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
                        }
                    ?>
                </form>
                </td>
                </tr>
                <?php
                }
            }
            ?>
            </table>
        </form>
        
    </body>
</html>