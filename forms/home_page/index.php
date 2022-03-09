<?php
	session_start();
?>

<!DOCTYPE html>
<html>  
<head>  
    <title>Home Page</title>
	<!Style>
	<link rel = "stylesheet" href = "home_page.css">
	<!Audio functionality>
	<script src = "../audio/audio.js"></script>
</head>  
<body>
	<!Top of the page>
	<div id = "header">
		<a href = "index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart">
		</a>
	</div>

	<!Center of the page>
	<div id = "mid">
		Welcome!
		<br> 
		What do you need?
	</div>

	<!Side of the page with links to various pages>
	<div id = "sidebar">
		<br><br>
		<a href = "index.php" class = "link">
			Home
		</a><br><br><br><br><br>

		<!Determine if links should be displayed based upon login status>
		<?php
			if(!(isset($_SESSION['ULID'])))
			{
		?>
				<a href = "../login_forms/login.html" class = "link">
					Log In
				</a><br><br><br><br><br>
				<a href = "../registration_forms/registration.html" class = "link">
					Sign Up
				</a><br><br><br><br><br>
		<?php
			}
			else
			{	
		?>
				<a href = "../profile_forms/profile_page.php" class = "link">
					Profile
				</a><br><br><br><br><br>
				<a href = "../login_forms/logout.php" class = "link">
					Log Out
				</a><br><br><br><br><br>
		<?php
			}
		?>

		<a href = "../inventory_forms/customer_shopping.php" class = "link">
			Shop
		</a><br><br><br><br><br>
		<a href = "../faq_forms/faq.html" class = "link">
			FAQ
		</a><br><br><br><br><br>
		<a href = "info_page.html" class = "link">
			About Us
		</a><br><br><br><br><br>
	</div>

	<!Bottom of the page>
	<div id = "footer">
		<!Music playing on the page>
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" autoplay loop controls></audio>
		<!Footer images>
		<img id = "poke_ball" src = "../../img/lnt/poke_ball.png" alt = "Poke Ball">
	</div>
</body>     
</html> 