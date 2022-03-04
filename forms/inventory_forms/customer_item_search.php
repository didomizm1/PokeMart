<?php

//connect to database
include_once('../connect_mysql.php');

if(isset($_POST['submit']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `inventory` WHERE CONCAT(`IID`, `item_name`, `japanese_item_name`, `selling_price`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else 
 {
    $query = "SELECT * FROM `inventory`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost","root","","pokemart_db");
    //$connect = include_once('connect_mysql.php');
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Customer Item Search</title>
        <h1>Customer Item Search</h1>

        
        
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
            .ShoppingCart 
            {
                width: 30%;
                position: fixed; 
                right: 0;
                padding-left: 15px;
                margin-left: 15px;
                float: right;
                background-color: lightgray;
            }
        </style>
    </head>
    <body>

        <aside>
        <p>Shopping Cart</p>
        </aside>

        <div class="ShoppingCart">
        <form action="shopping_cart.php" method="post">
            <h2>Shopping Cart</h2>
            <p>Items In Cart: <?php echo $row['number_of_items'];?></p>
        </div>
        
        <form action="customer_item_search.php" method="post">
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
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['IID'];?></td>
                    <td><?php echo $row['item_name'];?></td>
                    <td><?php echo $row['japanese_item_name'];?></td>
                    <td><?php echo $row['item_type'];?></td>
                    <td><?php echo $row['item_description'];?></td>
                    <td><?php echo $row['selling_price'];?></td>
                    <td>
                    <form action="shopping_cart.php" method="post">
                    <button id="button"> Add to Shopping Cart </button>
                    </td>
                </tr>
                <?php endwhile;?>
            </table>


            <script>
        // Get the button that opens the modal
        var button = document.getElementById("button");
        // When the user clicks the button, open the modal 
        button.onclick = function() 
        {
            
        }

        


</script>
        </form>
        
    </body>
</html>