<?php
	//database connection
	include_once('../connect_mysql.php');
	
	//session handling
	require_once('../session.php');

	//get user profile data associated with logged in user
	$query = "SELECT * FROM `user_profile` WHERE `ULID` = '".$_SESSION['ULID']."'";
    $result = mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
    $row = $result->fetch_array(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>  
<head>  
    <title>Profile Page</title>
	<!Style>
	<link rel = "stylesheet" href = "profile_page.css">
</head>  
<body>
	<!Top of the page>
	<div id = "header">
		<a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart">
		</a>
	</div>

	<!Center of the page>
	<div id = "mid">
		<h1 id = "header">Profile Page</h1>
		<p>
			<label class = "dataName">First Name</label><br>
			<label class = "dataInfo"><?php echo $row['first_name'];?></label>
		</p>
		<p>
			<label class = "dataName">Middle Name</label><br>
			<label class = "dataInfo"><?php echo $row['middle_name'];?></label>
		</p>
		<p>
			<label class = "dataName">Last Name</label><br>
			<label class = "dataInfo"><?php echo $row['last_name'];?></label>
		</p>
		<p>
			<label class = "dataName">Gender</label><br>
			<label class = "dataInfo"><?php echo $row['gender'];?></label>
		</p>
		<p>
			<label class = "dataName">Date of Birth</label><br>
			<label class = "dataInfo"><?php echo $row['date_of_birth'];?></label>
		</p>
		<p>
			<label class = "dataName">E-mail</label><br>
			<label class = "dataInfo"><?php echo $row['email'];?></label>
		</p>
		<p>
			<label class = "dataName">Home Phone Number</label><br>
			<label class = "dataInfo"><?php echo $row['home_phone_number'];?></label>
		</p>
		<p>
			<label class = "dataName">Cell Phone Number</label><br>
			<label class = "dataInfo"><?php echo $row['cell_phone_number'];?></label>
		</p>
		<p>
			<label class = "dataName">Street Address 1</label><br>
			<label class = "dataInfo"><?php echo $row['street_1'];?></label>
		</p>
		<p>
			<label class = "dataName">Street Address 2</label><br>
			<label class = "dataInfo"><?php echo $row['street_2'];?></label>
		</p>
		<p>
			<label class = "dataName">City</label><br>
			<label class = "dataInfo"><?php echo $row['city'];?></label>
		</p>
		<p>
			<label class = "dataName">State</label><br>
			<label class = "dataInfo"><?php echo $row['state'];?></label>
		</p>
		<p>
			<label class = "dataName">Zip Code</label><br>
			<label class = "dataInfo"><?php echo $row['zip_code'];?></label>
		</p>
		<p>
			<label class = "dataName">Country</label><br>
			<label class = "dataInfo"><?php echo $row['country'];?></label>
		</p>
		
	</div>

	<!Bottom of the page>
	<div id = "footer">
		<!Music playing on the page>
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
	</div>
</body>     
</html> 
