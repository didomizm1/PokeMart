<?php
	session_start();
?>

<!DOCTYPE html>
<html>  
<head>  
    <title>Home Page</title>
	<!-- Style -->
	<link rel = "stylesheet" href = "home_page.css">
	<!-- Audio functionality -->
	<!-- <script src = "../audio/audio.js"></script> -->
</head>  
<body>
	<!-- Top of the page -->
	<div id = "header">
		<a href = "index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart">
		</a>
	</div>

	<!-- Center of the page -->
	<div id = "mid">
		<img id = "welcome" src = "../../img/lnt/welcome.png" alt = "Welcome">
	</div>

	<!-- Side of the page with links to various pages -->
	<div id = "sidebar">
		<br>
		<a href = "index.php">
			<img id = "home" src = "../../img/lnt/home.png" alt = "Home" class = "imageLink">
		</a><br><br>

		<!-- Determine if links should be displayed based upon login status and employee status -->
		<?php
			if(!(isset($_SESSION['ULID'])))
			{
		?>
				<a href = "../login_forms/login.html">
					<img id = "login" src = "../../img/lnt/login.png" alt = "Log In" class = "imageLink">
				</a><br><br>
				<a href = "../registration_forms/registration.html">
					<img id = "register" src = "../../img/lnt/signup.png" alt = "Sign Up" class = "imageLink">
				</a><br><br>
		<?php
			}
			else
			{	
		?>
				<a href = "../profile_forms/profile_page.php">
					<img id = "profile" src = "../../img/lnt/profile.png" alt = "Profile" class = "imageLink">
				</a><br><br>
		<?php
				if($_SESSION['user_role_type'] > 0)
				{
		?>
					<a href = "../employee_forms/employee_hub.php">
						<img id = "employee_hub" src = "../../img/lnt/employee_hub2.png" alt = "Employee Hub" class = "imageLink">
					</a><br><br>
		<?php
				}
		?>
				<a href = "../login_forms/logout.php">
					<img id = "logout" src = "../../img/lnt/logout.png" alt = "Log Out" class = "imageLink">
				</a><br><br>
		<?php
			}
		?>

		<a href = "../inventory_forms/customer_shopping.php">
			<img id = "shop" src = "../../img/lnt/shop.png" alt = "Shop" class = "imageLink">
		</a><br><br>
		<a href = "../faq_forms/faq.html">
			<img id = "faq" src = "../../img/lnt/faq.png" alt = "FAQ" class = "imageLink">
		</a><br><br>
		<a href = "info_page.html">
			<img id = "info_page" src = "../../img/lnt/about_us.png" alt = "About Us" class = "imageLink">
		</a><br><br>
	</div>

	<!-- Bottom of the page -->
	<div id = "footer">
		<!-- Music playing on the page -->
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
		<!-- Footer images -->
		<img id = "poke_ball" src = "../../img/lnt/poke_ball.png" alt = "Poke Ball">
	</div>
</body>     
</html> 