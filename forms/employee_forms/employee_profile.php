<?php
	//database connection
	include_once('../connect_mysql.php');

	//session handling
	require_once('../employee_session.php');

	//get user profile data associated with logged in employee
	$query = "SELECT * FROM `employee_profile` WHERE `EPID` = '".$_SESSION['EPID']."'";
	$result = mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
	$row = $result->fetch_array(MYSQLI_ASSOC);
?>

<!-- Displays information specific to an employee's profile -->
<!DOCTYPE html>
<html>  
<head>  
    <title>Employee Profile Page</title>
	<!-- Style -->
	<link rel = "stylesheet" href = "employee_profile.css">
</head>  
<body>
	<!-- Top of the page -->
	<div id = "header">
		<a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart">
		</a>
	</div>

	<!-- Center of the page -->
	<div id = "mid">
        <!-- Print out employee profile data -->
		<h1 id = "header">Employee Profile Page</h1>
		<p>
			<label class = "dataName">Employee ID</label><br>
			<label class = "dataInfo"><?php echo $row['EPID'];?></label>
		</p>
		<p>
			<label class = "dataName">Position</label><br>
			<label class = "dataInfo"><?php echo $row['position'];?></label>
		</p>
		<p>
			<label class = "dataName">Location</label><br>
			<label class = "dataInfo"><?php echo $row['location'];?></label>
		</p>
		<p>
			<label class = "dataName">Salary</label><br>
			<label class = "dataInfo">$<?php echo $row['salary'];?></label>
		</p>
	</div>

	<!-- Bottom of the page -->
	<div id = "footer">
		<!-- Music controls -->
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
	</div>
</body>     
</html>
