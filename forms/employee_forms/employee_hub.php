<?php
    //session handling
	require_once('../session.php');
?>

<!Connects to employee profile, user control panel, vendors, employee inventory, z-report, etc.>
<!DOCTYPE html>
<html>  
<head>  
    <title>Employee Hub</title>
	<!Style>
	<link rel = "stylesheet" href = "employee_hub.css">
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
        <img id = "employee_hub" src = "../../img/lnt/employee_hub.png" alt = "Employee Hub">

        <!Links to various employee pages>
		<a href = "employee_profile.php">
			<img id = "employee_profile" src = "../../img/lnt/employee_profile.png" alt = "Employee Profile">
		</a>
        <a href = "user_control_panel.php">
			<img id = "user_control_panel" src = "../../img/lnt/user_control_panel.png" alt = "User Control Panel">
		</a>
        <a href = "../vendor_forms/vendor_page.html">
			<img id = "vendors" src = "../../img/lnt/vendors2.png" alt = "Vendors">
		</a>
        <a href = "../inventory_forms/employee_inventory.html">
			<img id = "employee_inventory" src = "../../img/lnt/employee_inventory.png" alt = "Employee Inventory">
		</a>
        <a href = "../z_report/lookup_z_report.html">
			<img id = "z_report" src = "../../img/lnt/z_report.png" alt = "Z-Report">
		</a>
	</div>

	<!Bottom of the page>
	<div id = "footer">
		<!Music controls>
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
	</div>
</body>     
</html>
