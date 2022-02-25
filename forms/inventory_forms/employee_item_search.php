<?php

//connect to database
include_once('../connect_mysql.php');

if(isset($_POST['submit']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `inventory` WHERE CONCAT(`IID`, `VID`, `item_name`, `japanese_item_name`, `item_description`, `item_type`, `selling_price`, `cost`, `in_stock`, `reorder_amount`, `base_stock`) LIKE '%".$valueToSearch."%'";
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
        <title>Employee Item Lookup</title>
        <style>
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        
        <form action="employee_item_search.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Search"><br><br>
            <input type="submit" name="submit" value="Filter"><br><br>
            
            <table>
                <tr>
                    <th>Product ID</th>
                    <th>VID</th>
                    <th>Item Name</th>
                    <th>Japanese</th>
                    <th>Item Type</th>
                    <th>Item Description</th>
                    <th>Selling Price</th>
                    <th>Cost</th>
                    <th>In Stock</th>
                    <th>Reorder Amount</th>
                    <th>Base Stock</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['IID'];?></td>
                    <td><?php echo $row['VID'];?></td>
                    <td><?php echo $row['item_name'];?></td>
                    <td><?php echo $row['japanese_item_name'];?></td>
                    <td><?php echo $row['item_type'];?></td>
                    <td><?php echo $row['item_descriptopn'];?></td>
                    <td><?php echo $row['selling_price'];?></td>
                    <td><?php echo $row['cost'];?></td>
                    <td><?php echo $row['in_stock'];?></td>
                    <td><?php echo $row['reorder_amount'];?></td>
                    <td><?php echo $row['base_stock'];?></td>
                </tr>
                <?php endwhile;?>
            </table>
        </form>
        
    </body>
</html>