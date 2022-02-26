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
        <title>Employee Inventory</title>
        <h1>Employee Inventory</h1>
        <style>
            /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        input.right 
            {
                position: absolute;
                height:25px; 
                width:100px;
                right: 175px;
                top: 275px;
            }
            table,tr,th,td
            {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>

<form action="add_item.php" method="post">

<!-- Trigger/Open The Modal -->
<button id="myBtn">Add item</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>NEW ITEM ENTRY</h2>
    <label> * Item Name: 
		<input type = "text" name  = "item_name" maxlength = "50" required/>
	</label>
    <label> Japanese Translation: 
		<input type = "text" name  = "japanese_item_name" maxlength = "50"/>
	</label>
    <label> Item Description: 
		<input type = "text" name  = "item_description" maxlength = "50"/>
	</label>
    <label> Item Type: 
		<input type = "text" name  = "item_type" maxlength = "50"/>
	</label>
    <br>
    <br>
    <label> * Vendor ID: 
		<input type = "number" min="1" max="6" step="1" name  = "VID" maxlength = "1" required/>
	</label>
    <label> * Selling Price: 
		<input type = "number" min="0" step="0.01" name  = "selling_price" maxlength = "10" required/>
	</label>
    <label> * Cost per unit: 
		<input type = "number" min="0" step="0.01" name  = "cost" maxlength = "10" required/>
	</label>
    <br>
    <br>
    <label> In stock: 
		<input type = "number" name  = "in_stock" maxlength = "10" />
	</label>
    <label> * Order amount: 
		<input type = "number" name  = "reorder_amount" maxlength = "10" required/>
	</label>
    <label> * Base stock: 
		<input type = "number" name  = "base_stock" maxlength = "10" required/>
	</label>
    <br>
    <br>
    <input type="submit" name = "submit" class = "right">
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

</script>
</form>
        
        <form action="employee_inventory.php" method="post">
            <br>
            <br>
            <input type="text" name="valueToSearch" placeholder="Search"><br><br>
            <input type="submit" name="submit" value="Filter"><br><br>
            
            <table>
                <tr>
                    <th>IID</th>
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
                    <td><?php echo $row['item_description'];?></td>
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