<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Show dynamic Drop Down List in PHP by fetching MySQL database data</title>
</head>

<body>


<?php

include_once('../connect_mysql.php');

$query = "SELECT * FROM inventory value";
$search_result = filterTable($query);

?>
<h2> Dynamic Drop Down List </h2>
 
 <form method="post" action="modify_item.php">
 
 <label >Items</label>
 
 <select name="item_name">
 
 <option>---Select item---</option>
 
 <?php while($row = mysqli_fetch_array($search_result)){ ?>
 
<option value="<?php echo $row['item_name'];?>"> <?php echo $row['item_name'];?>

</option>

<?php }?> 

 </select>
 
 </form>

</body>
</html>