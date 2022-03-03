<?php
//delete_item.php

if(isset($_POST['submit']))
{
    //connect to database
    include_once('../connect_mysql.php');

    //add query
   //$query = "DELETE FROM inventory WHERE item_name = .$_POST['item_name]."');

    //execute queries
   // mysqli_query($dbconn, $query) or die("Couldn't execute login data query\n");
    
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
<form action="delete_item.php" method="post">

<h2>Delete Test</h2>

<!-- Trigger/Open The Modal -->
<button id="myBtn">Delete item</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2> ITEM DELETE</h2>
    <label> * Item Name: 
		<input type = "text" name  = "item_name" maxlength = "50" required/>
	</label>
    <label> * IID: 
		<input type = "number" min="1" max="6" step="1" name  = "VID" maxlength = "1" required/>
	</label>
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
</form>
</body>
</html>