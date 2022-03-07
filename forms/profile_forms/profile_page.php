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
		<p>
			<label><?php echo $row['first_name'];?></label>
		</p>
		<p>
			<label><?php echo $row['middle_name'];?></label>
		</p>
		<p>
			<label><?php echo $row['last_name'];?></label>
		</p>
		<p>
			<label><?php echo $row['gender'];?></label>
		</p>
		<p>
			<label><?php echo $row['date_of_birth'];?></label>
		</p>
		<p>
			<label><?php echo $row['email'];?></label>
		</p>
		<p>
			<label><?php echo $row['home_phone_number'];?></label>
		</p>
		<p>
			<label><?php echo $row['cell_phone_number'];?></label>
		</p>
		<p>
			<label><?php echo $row['street_1'];?></label>
		</p>
		<p>
			<label><?php echo $row['street_2'];?></label>
		</p>
		<p>
			<label><?php echo $row['city'];?></label>
		</p>
		<p>
			<label><?php echo $row['state'];?></label>
		</p>
		<p>
			<label><?php echo $row['zip_code'];?></label>
		</p>
		<p>
			<label><?php echo $row['country'];?></label>
		</p>
		
	</div>

	<!Bottom of the page>
	<div id = "footer">
		<!Music playing on the page>
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
	</div>
</body>     
</html> 
