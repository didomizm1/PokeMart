<?php
	//database connection
	include_once('../connect_mysql.php');

    //session handling
	require_once('../session.php');
?>

<!-- Used for employee editing of user profiles -->
<!DOCTYPE html>
<html>  
<head>  
    <title>User Control Panel</title>
	<!-- Style -->
	<link rel = "stylesheet" href = "user_control_panel.css">
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
        
	</div>

	<!-- User management form -->
	<div id = "form">
		<h1 id = "header">User Control Panel</h1>
		<h3 id = "header">To search for a user, input their username and press enter</h3>
		<form method = "POST">
			<p> <!-- Includes search bar for usernames -->
				<label> 
					<input type = "search" name  = "search" minlength = "6" maxlength = "32" pattern = "^[a-zA-Z\d_]+$" placeholder = "Search users..." autofocus required />
					<input type = "submit" name = "searchSubmit" hidden />
				</label>  
			</p>
			<p> <!-- Displays info related to a user and allows for editing -->
				<?php
					if(isset($_POST['searchSubmit']))
					{
						$username = $_POST['search'];

						//get ULID associated with entered username
						$query1 = "SELECT `ULID` FROM `user_login` WHERE `username` = '$username'";
						$result1 = mysqli_query($dbconn, $query1) or die("Couldn't execute query\n");
						$row1 = $result1->fetch_array(MYSQLI_ASSOC);

						if($row1 != null) //if username was found, display data
						{
							//get profile data from ULID
							$query2 = "SELECT * FROM `user_profile` WHERE `ULID` = '".$row1['ULID']."'";
							$result2 = mysqli_query($dbconn, $query2) or die("Couldn't execute query\n");
							$row2 = $result2->fetch_array(MYSQLI_ASSOC);
				?>
							<h2 id = "header"><?php echo $username; ?>'s Data</h2>
							<p> <!-- Username -->
								<label class = "displayInfo"> Username:
									<input type = "text" name = "username" readonly value = "<?php echo $username; ?>" /> 
								</label>
								<label class = "enterInfo"> New username:
									<input type = "text" name = "usernameInput" minlength = "6" maxlength = "32" pattern = "^[a-zA-Z\d_]+$" /> 
								</label>
							</p>
							<p> <!-- User Role Type -->
								<?php
									//array for role type values
									$array = [0 => "Customer", 1 => "Employee", 2 => "Admin", 3 => "Owner"]; 
								?>
								<label class = "displayInfo"> User role type:
									<input type = "text" name = "userRoleType" readonly value = "<?php echo $array[$row2['user_role_type']]; ?>" /> 
								</label>
								<label class = "enterInfo"> New user role type:
									<select name = "userRoleTypeInput">
										<option value = "0">Customer</option>
										<option value = "1">Employee</option>
										<option value = "2">Admin</option>
										<option value = "3">Owner</option>
									</select> 
								</label>
							</p>
				<?php
						}
						else //if user does not exist, display an error message
						{
				?>
							<h2 id = "header"><?php echo "User not found. Try again." ?></h2>
				<?php 
						}
					}
				?>
			</p>
		</form>
	</div>

	<!-- Bottom of the page -->
	<div id = "footer">
		<!-- Music controls -->
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
	</div>
</body>     
</html>
