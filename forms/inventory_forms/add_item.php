<?php
//add_item.php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //add query
    $query = "INSERT INTO `inventory` (`VID`,`item_name`, `japanese_item_name`, `item_description`, `item_type`, `selling_price`, `cost`, `in_stock`, `reorder_amount`, `base_stock`);
    VALUES ('".$_POST['VID']."','".$_POST['item_name']."','".$_POST['japanese_item_name']."','".$_POST['item_description']."','".$_POST['item_type']."'
    ,'".$_POST['selling_price']."','".$_POST['cost']."','".$_POST['in_stock']."','".$_POST['reorder_amount']."','".$_POST['base_stock']."')";

    //execute queries
    mysqli_query($dbconn, $query) or die("Couldn't execute login data query\n");
    
    if($dbconn->query($query)==TRUE)
    {
        echo nl2br("Item added successfully\n");
    }
    else
    {
        echo nl2br("Error: " . $query . "<br>" . $dbconn->error . "\n");
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

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
</style>
</head>
<body>
<form action="add_item.php" method="post">

<h2>Add Test</h2>

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
    <input type="submit" name = submit class = "right">
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

</body>
</html>
