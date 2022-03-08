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
        <a href = "../home_page/index.php"><!-- makes logo link to homepage -->
  <IMG SRC="../../img/lnt/logo.png" width="300" >
</a>
        <h1>Employee Inventory</h1>
        <link rel = "stylesheet" href = "employee_inventory.css">
    </head>
    <body>
      
<form action="add_item.php" method="post">

<!-- Trigger/Open The Modal -->
<button id="addButton">Add item</button>

<!-- The Modal -->
<div id="addModal" class="modal" style="display: none;">

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
		<input type = "number" min="1" step="1" name  = "VID" maxlength = "1" required/>
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
var addModal = document.getElementById("addModal");

// Get the button that opens the modal
var btn1 = document.getElementById("addButton");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn1.onclick = function() {
  addModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  addModal.style.display = "none";
}
</script>
</form>
<br>
        
<form action="delete_item.php" method="post">
<!-- Trigger/Open The Modal -->
<button id="deleteButton">Delete item</button>
<!-- The Modal -->
<div id="deleteModal" class="modal" style="display: none;">
<!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2> ITEM DELETE</h2>
    <label> * Item Name: 
		<input type = "text" name  = "item_name" maxlength = "50" required/>
	</label>
    <label> * IID: 
		<input type = "number" step="1" name  = "IID" maxlength = "50" required/>
	</label>
   <br>
   <br>
   <br>
    <input type="submit" name = submit class = "right">
  </div>

</div>

<script>
// Get the modal
var deleteModal = document.getElementById("deleteModal");

// Get the button that opens the modal
var btn2 = document.getElementById("deleteButton");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close")[1];

// When the user clicks the button, open the modal 
btn2.onclick = function() {
  deleteModal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
    deleteModal.style.display = "none";
}
</script>
</form>
<br>
        
<form action="update_item.php" method="post">
<!-- Trigger/Open The Modal -->
<button id="updateButton">Update item</button>
<!-- The Modal -->
<div id="updateModule" class="modal" style="display: none;">
  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>UPDATE ITEM ENTRY</h2>
		* Product ID: <input type="text" name="IID" required>
        <!-- item info selection -->
		<select id="info" name="info">
    		<option value="item_name">Item name</option>
            <option value="japanese_item_name">japanese_item_name</option>
    		<option value="item_description">Item description</option>
    		<option value="item_type">Item type</option>
    		<option value="VID">Vendor ID</option>
   			<option value="selling_price">Selling price</option>
   			<option value="cost">Cost per unit</option>
 			<option value="in_Stock">In stock</option>
 			<option value="reorder_amount">Reorder amount</option>
 			<option value="base_stock">Base stock</option>
  		</select>
    <br>
    * Updated Information: <input type="text" name="update" required>
    <br>
    <br>
    <input type="submit" name = "submit" value="Update">
  </div>

</div>

<script>
// Get the modal
var updateModal = document.getElementById("updateModal");

// Get the button that opens the modal
var btn3 = document.getElementById("updateButton");

// Get the <span> element that closes the modal
var span3 = document.getElementsByClassName("close")[2];

// When the user clicks the button, open the modal 
btn3.onclick = function() {
  updateModal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span3.onclick = function() {
  updateModal.style.display = "none";
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