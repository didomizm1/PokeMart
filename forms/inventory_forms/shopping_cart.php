<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
require_once('../session.php');

//get user profile data associated with logged in user
$SCID = $_SESSION['SCID'];

if(isset($_POST['submit']))
{
    //$query ="SELECT * FROM cart_item WHERE SCID = '$SCID'";
    $query2 = "SELECT * FROM inventory WHERE cart_item (IID) = inventory (IID) AND cart_item (SCID) = '$SCID'";
    $search_result = filterTable($query2);
}


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart Test</title>
       <!-- <h1>PokéMart Store!</h1>-->

	    <link rel = "stylesheet" href = "shopping_cart.css">

    </head>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart" width="300"> 
        </a>

        <form action="shopping_cart.php" method="post">
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['IID'];?></td>
                    <td><?php echo $row['item_name'];?></td>
                    <td><?php echo $row['selling_price'];?></td>
                    <td><?php echo $row['quantity'];?></td>
                    <form action="remove_from_cart.php" method="post">
                    <input type="submit" name="submit" value="Remove from Cart">
                    </form>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>