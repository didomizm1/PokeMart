<?php

//connect to database
include_once('../connect_mysql.php');
//session handling
//require_once('../session.php');

if(isset($_POST['submit']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `inventory` WHERE CONCAT(`IID`, `item_name`, `japanese_item_name`, `selling_price`) LIKE '%".$valueToSearch."%'";
    $result = mysqli_query($dbconn, $query);
    
}
else 
{
    $query = "SELECT * FROM `inventory`";
    $result = mysqli_query($dbconn, $query);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Customer Shopping</title>
       <!-- <h1>PokéMart Store!</h1>-->

	    <link rel = "stylesheet" href = "customer_shopping.css">

    </head>
    <div class="ShoppingCart">
        <form action="shopping_cart.php" method="post">
            
            <a href = "../shopping_cart.html"></a>
            <h2>Shopping Cart</h2>
            </a>
        </form>
        </div>
    <body>
        <a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart"> 
        </a>

        <form id = "form" action="customer_shopping.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Search"><br><br>
            <input type="submit" name="submit" value="Filter"><br><br>
            
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Item Name</th>
                    <th>Japanese Item Name</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php
                include_once('customer_shopping.php'); 
                while($row = mysqli_fetch_array($result)):?>
                <tr>
                    <td><?php echo $row['IID'];?></td>
                    <td><?php echo $row['item_name'];?></td>
                    <td><?php echo $row['japanese_item_name'];?></td>
                    <td><?php echo $row['item_type'];?></td>
                    <td><?php echo $row['item_description'];?></td>
                    <td><?php echo $row['selling_price'];?></td>
                    <form action="add_to_cart.php" method="post">
                    
                    <!--adding option to change quantity-->
                    <td>
                    <label> 
                    <input type = "number" min="0" step="1" name  = "quantity" maxlength = "10" required/>
                    </label> 
                    </td>
                    
                    <td>
                    <input type="submit" name="add" value="Add to Cart">
                    </form>
                    </td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>