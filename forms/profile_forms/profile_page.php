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
	<!-- Style -->
	<link rel = "stylesheet" href = "profile_page.css">
</head>  
<body>
	<!-- Top of the page -->
	<div id = "header">
		<a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart">
		</a>
		<img id = "profile_page" src = "../../img/lnt/profile_page.png" alt = "Profile Page">
	</div>

	<!-- Center of the page -->
	<div id = "mid">
		
		<!-- Links to related profile-specific pages -->
		<a href = "../inventory_forms/customer_order_history.php">
			<label class = "link header">Orders</label>
		</a>
		<a href = "../inventory_forms/wishlist.php">
			<label class = "link header">Wishlist</label>
		</a>
		<a href = "../card_forms/wallet.php">
			<label class = "link header">My Wallet</label> 
		</a>
		<img id = "torterra" src = "../../img/lnt/torterra.gif" alt = "Torterra">

		<!-- Print out profile data -->
		<p>
			<label class = "header">Profile Info</label>
		</p>
		<p>
			<label class = "dataName">Username</label><br>
			<?php
				$userLoginQuery = "SELECT `username` FROM `user_login` WHERE `ULID` = '".$_SESSION['ULID']."'";
				$userLoginResult = mysqli_query($dbconn, $userLoginQuery) or die("Couldn't execute query\n");
				$userLoginRow = $userLoginResult->fetch_array(MYSQLI_ASSOC);
			?> 
			<label class = "dataInfo" id = "username"><?php echo $userLoginRow['username'];?></label>
		</p>
		<p>
			<label class = "dataName">First Name</label><br> 
			<label class = "dataInfo" id = "first_name"><?php echo $row['first_name'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_first_name']) && !isset($_POST['cancel_first_name'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "text" name  = "first_name" maxlength = "50" placeholder = "New first name..." autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_first_name" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_first_name" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_first_name'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_first_name" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Middle Name</label><br>
			<label class = "dataInfo" id = "middle_name"><?php echo $row['middle_name'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_middle_name']) && !isset($_POST['cancel_middle_name'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "text" name  = "middle_name" maxlength = "50" placeholder = "New middle name..." autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_middle_name" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_middle_name" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_middle_name'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_middle_name" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Last Name</label><br>
			<label class = "dataInfo" id = "last_name"><?php echo $row['last_name'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_last_name']) && !isset($_POST['cancel_last_name'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "text" name  = "last_name" maxlength = "50" placeholder = "New last name..." autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_last_name" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_last_name" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_last_name'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_last_name" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Gender</label><br>
			<label class = "dataInfo" id = "gender"><?php echo $row['gender'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_gender']) && !isset($_POST['cancel_gender'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "radio" name  = "gender" value = "Male" /> Male
							<input type = "radio" name  = "gender" value = "Female" /> Female
							<input type = "radio" name  = "gender" value = "Other" /> Other
							<input type = "radio" name = "gender" value = "None" checked autofocus /> Prefer not to say
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_gender" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_gender" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_gender'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_gender" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Date of Birth</label><br>
			<label class = "dataInfo" id = "date_of_birth"><?php echo $row['date_of_birth'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_date_of_birth']) && !isset($_POST['cancel_date_of_birth'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "date" name  = "date_of_birth" autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_date_of_birth" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_date_of_birth" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_date_of_birth'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_date_of_birth" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">E-mail</label><br>
			<label class = "dataInfo" id = "email"><?php echo $row['email'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_email']) && !isset($_POST['cancel_email'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "email" name  = "email" maxlength = "100" placeholder = "name@mail.com" autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_email" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_email" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_email'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_email" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Home Phone Number</label><br>
			<label class = "dataInfo" id = "home_phone_number"><?php echo $row['home_phone_number'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_home_phone_number']) && !isset($_POST['cancel_home_phone_number'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "tel" name  = "home_phone_number" placeholder = "123-456-7890" pattern = "[0-9]{3}-[0-9]{3}-[0-9]{4}" autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_home_phone_number" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_home_phone_number" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_home_phone_number'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_home_phone_number" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Cell Phone Number</label><br>
			<label class = "dataInfo" id = "cell_phone_number"><?php echo $row['cell_phone_number'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_cell_phone_number']) && !isset($_POST['cancel_cell_phone_number'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
						<input type = "tel" name  = "cell_phone_number" placeholder = "123-456-7890" pattern = "[0-9]{3}-[0-9]{3}-[0-9]{4}" autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_cell_phone_number" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_cell_phone_number" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_cell_phone_number'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_cell_phone_number" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Street Address 1</label><br>
			<label class = "dataInfo" id = "street_1"><?php echo $row['street_1'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_street_1']) && !isset($_POST['cancel_street_1'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "text" name  = "street_1" maxlength = "100" placeholder = "New street address 1..." autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_street_1" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_street_1" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_street_1'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_street_1" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Street Address 2</label><br>
			<label class = "dataInfo" id = "street_2"><?php echo $row['street_2'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_street_2']) && !isset($_POST['cancel_street_2'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "text" name  = "street_2" maxlength = "100" placeholder = "New street address 2..." autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_street_2" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_street_2" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_street_2'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_street_2" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">City</label><br>
			<label class = "dataInfo" id = "city"><?php echo $row['city'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_city']) && !isset($_POST['cancel_city'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "text" name  = "city" maxlength = "100" placeholder = "New city..." autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_city" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_city" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_city'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_city" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">State</label><br>
			<label class = "dataInfo" id = "state"><?php echo $row['state'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_state']) && !isset($_POST['cancel_state'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>  
							<select name = "state" autofocus >
								<option value = "" selected></option>
								<option value = "Alabama">Alabama</option>
								<option value = "Alaska">Alaska</option>
								<option value = "Arizona">Arizona</option>
								<option value = "Arkansas">Arkansas</option>
								<option value = "California">California</option>
								<option value = "Colorado">Colorado</option>
								<option value = "Connecticut">Connecticut</option>
								<option value = "Delaware">Delaware</option>
								<option value = "District of Columbia">District of Columbia</option>
								<option value = "Florida">Florida</option>
								<option value = "Georgia">Georgia</option>
								<option value = "Hawaii">Hawaii</option>
								<option value = "Idaho">Idaho</option>
								<option value = "Illinois">Illinois</option>
								<option value = "Indiana">Indiana</option>
								<option value = "Iowa">Iowa</option>
								<option value = "Kansas">Kansas</option>
								<option value = "Kentucky">Kentucky</option>
								<option value = "Louisiana">Louisiana</option>
								<option value = "Maine">Maine</option>
								<option value = "Maryland">Maryland</option>
								<option value = "Massachusetts">Massachusetts</option>
								<option value = "Michigan">Michigan</option>
								<option value = "Minnesota">Minnesota</option>
								<option value = "Mississippi">Mississippi</option>
								<option value = "Missouri">Missouri</option>
								<option value = "Montana">Montana</option>
								<option value = "Nebraska">Nebraska</option>
								<option value = "Nevada">Nevada</option>
								<option value = "New Hampshire">New Hampshire</option>
								<option value = "New Jersey">New Jersey</option>
								<option value = "New Mexico">New Mexico</option>
								<option value = "New York">New York</option>
								<option value = "North Carolina">North Carolina</option>
								<option value = "North Dakota">North Dakota</option>
								<option value = "Ohio">Ohio</option>
								<option value = "Oklahoma">Oklahoma</option>
								<option value = "Oregon">Oregon</option>
								<option value = "Pennsylvania">Pennsylvania</option>
								<option value = "Rhode Island">Rhode Island</option>
								<option value = "South Carolina">South Carolina</option>
								<option value = "South Dakota">South Dakota</option>
								<option value = "Tennessee">Tennessee</option>
								<option value = "Texas">Texas</option>
								<option value = "Utah">Utah</option>
								<option value = "Vermont">Vermont</option>
								<option value = "Virginia">Virginia</option>
								<option value = "Washington">Washington</option>
								<option value = "West Virginia">West Virginia</option>
								<option value = "Wisconsin">Wisconsin</option>
								<option value = "Wyoming">Wyoming</option>
							</select>
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_state" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_state" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_state'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_state" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Zip Code</label><br>
			<label class = "dataInfo" id = "zip_code"><?php echo $row['zip_code'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_zip_code']) && !isset($_POST['cancel_zip_code'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<input type = "text" name  = "zip_code" minlength = "5" maxlength = "10" pattern = "^[A-Z\d]+$" placeholder = "New zip code..." autofocus autocomplete required />
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_zip_code" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_zip_code" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_zip_code'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_zip_code" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>
		<p>
			<label class = "dataName">Country</label><br>
			<label class = "dataInfo" id = "country"><?php echo $row['country'];?></label>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_country']) && !isset($_POST['cancel_country'])) //check for edit button click, display text field if it has been clicked
					{
				?>
						<label>
							<select name = "country" autofocus >
								<option value = "Afghanistan">Afghanistan</option>
								<option value = "Albania">Albania</option>
								<option value = "Algeria">Algeria</option>
								<option value = "American Samoa">American Samoa</option>
								<option value = "Andorra">Andorra</option>
								<option value = "Angola">Angola</option>
								<option value = "Anguilla">Anguilla</option>
								<option value = "Antigua and Barbuda">Antigua and Barbuda</option>
								<option value = "Argentina">Argentina</option>
								<option value = "Armenia">Armenia</option>
								<option value = "Aruba">Aruba</option>
								<option value = "Australia">Australia</option>
								<option value = "Austria">Austria</option>
								<option value = "Azerbaijan">Azerbaijan</option>
								<option value = "Bahamas">Bahamas</option>
								<option value = "Bahrain">Bahrain</option>
								<option value = "Bangladesh">Bangladesh</option>
								<option value = "Barbados">Barbados</option>
								<option value = "Belarus">Belarus</option>
								<option value = "Belgium">Belgium</option>
								<option value = "Belize">Belize</option>
								<option value = "Benin">Benin</option>
								<option value = "Bermuda">Bermuda</option>
								<option value = "Bhutan">Bhutan</option>
								<option value = "Bolivia">Bolivia</option>
								<option value = "Bonaire">Bonaire</option>
								<option value = "Bosnia and Herzegovina">Bosnia and Herzegovina</option>
								<option value = "Botswana">Botswana</option>
								<option value = "Brazil">Brazil</option>
								<option value = "British Indian Ocean Territory">British Indian Ocean Territory</option>
								<option value = "Brunei">Brunei</option>
								<option value = "Bulgaria">Bulgaria</option>
								<option value = "Burkina Faso">Burkina Faso</option>
								<option value = "Burundi">Burundi</option>
								<option value = "Cambodia">Cambodia</option>
								<option value = "Cameroon">Cameroon</option>
								<option value = "Canada">Canada</option>
								<option value = "Canary Islands">Canary Islands</option>
								<option value = "Cape Verde">Cape Verde</option>
								<option value = "Cayman Islands">Cayman Islands</option>
								<option value = "Central African Republic">Central African Republic</option>
								<option value = "Chad">Chad</option>
								<option value = "Channel Islands">Channel Islands</option>
								<option value = "Chile">Chile</option>
								<option value = "China">China</option>
								<option value = "Christmas Island">Christmas Island</option>
								<option value = "Cocos Island">Cocos Island</option>
								<option value = "Colombia">Colombia</option>
								<option value = "Comoros">Comoros</option>
								<option value = "Congo">Congo</option>
								<option value = "Cook Islands">Cook Islands</option>
								<option value = "Costa Rica">Costa Rica</option>
								<option value = "Cote DIvoire">Cote DIvoire</option>
								<option value = "Croatia">Croatia</option>
								<option value = "Cuba">Cuba</option>
								<option value = "Curaco">Curacao</option>
								<option value = "Cyprus">Cyprus</option>
								<option value = "Czech Republic">Czech Republic</option>
								<option value = "Denmark">Denmark</option>
								<option value = "Djibouti">Djibouti</option>
								<option value = "Dominica">Dominica</option>
								<option value = "Dominican Republic">Dominican Republic</option>
								<option value = "East Timor">East Timor</option>
								<option value = "Ecuador">Ecuador</option>
								<option value = "Egypt">Egypt</option>
								<option value = "El Salvador">El Salvador</option>
								<option value = "Equatorial Guinea">Equatorial Guinea</option>
								<option value = "Eritrea">Eritrea</option>
								<option value = "Estonia">Estonia</option>
								<option value = "Ethiopia">Ethiopia</option>
								<option value = "Falkland Islands">Falkland Islands</option>
								<option value = "Faroe Islands">Faroe Islands</option>
								<option value = "Fiji">Fiji</option>
								<option value = "Finland">Finland</option>
								<option value = "France">France</option>
								<option value = "French Guiana">French Guiana</option>
								<option value = "French Polynesia">French Polynesia</option>
								<option value = "French Southern and Antarctic Lands">French Southern and Antarctic Lands</option>
								<option value = "Gabon">Gabon</option>
								<option value = "Gambia">Gambia</option>
								<option value = "Georgia">Georgia</option>
								<option value = "Germany">Germany</option>
								<option value = "Ghana">Ghana</option>
								<option value = "Gibraltar">Gibraltar</option>
								<option value = "Great Britain">Great Britain</option>
								<option value = "Greece">Greece</option>
								<option value = "Greenland">Greenland</option>
								<option value = "Grenada">Grenada</option>
								<option value = "Guadeloupe">Guadeloupe</option>
								<option value = "Guam">Guam</option>
								<option value = "Guatemala">Guatemala</option>
								<option value = "Guinea">Guinea</option>
								<option value = "Guyana">Guyana</option>
								<option value = "Haiti">Haiti</option>
								<option value = "Hawaii">Hawaii</option>
								<option value = "Honduras">Honduras</option>
								<option value = "Hong Kong">Hong Kong</option>
								<option value = "Hungary">Hungary</option>
								<option value = "Iceland">Iceland</option>
								<option value = "Indonesia">Indonesia</option>
								<option value = "India">India</option>
								<option value = "Iran">Iran</option>
								<option value = "Iraq">Iraq</option>
								<option value = "Ireland">Ireland</option>
								<option value = "Isle of Man">Isle of Man</option>
								<option value = "Israel">Israel</option>
								<option value = "Italy">Italy</option>
								<option value = "Jamaica">Jamaica</option>
								<option value = "Japan">Japan</option>
								<option value = "Jordan">Jordan</option>
								<option value = "Kazakhstan">Kazakhstan</option>
								<option value = "Kenya">Kenya</option>
								<option value = "Kiribati">Kiribati</option>
								<option value = "Kuwait">Kuwait</option>
								<option value = "Kyrgyzstan">Kyrgyzstan</option>
								<option value = "Laos">Laos</option>
								<option value = "Latvia">Latvia</option>
								<option value = "Lebanon">Lebanon</option>
								<option value = "Lesotho">Lesotho</option>
								<option value = "Liberia">Liberia</option>
								<option value = "Libya">Libya</option>
								<option value = "Liechtenstein">Liechtenstein</option>
								<option value = "Lithuania">Lithuania</option>
								<option value = "Luxembourg">Luxembourg</option>
								<option value = "Macau">Macau</option>
								<option value = "Macedonia">Macedonia</option>
								<option value = "Madagascar">Madagascar</option>
								<option value = "Malaysia">Malaysia</option>
								<option value = "Malawi">Malawi</option>
								<option value = "Maldives">Maldives</option>
								<option value = "Mali">Mali</option>
								<option value = "Malta">Malta</option>
								<option value = "Marshall Islands">Marshall Islands</option>
								<option value = "Martinique">Martinique</option>
								<option value = "Mauritania">Mauritania</option>
								<option value = "Mauritius">Mauritius</option>
								<option value = "Mayotte">Mayotte</option>
								<option value = "Mexico">Mexico</option>
								<option value = "Midway Islands">Midway Islands</option>
								<option value = "Moldova">Moldova</option>
								<option value = "Monaco">Monaco</option>
								<option value = "Mongolia">Mongolia</option>
								<option value = "Montserrat">Montserrat</option>
								<option value = "Morocco">Morocco</option>
								<option value = "Mozambique">Mozambique</option>
								<option value = "Myanmar">Myanmar</option>
								<option value = "Nambia">Nambia</option>
								<option value = "Nauru">Nauru</option>
								<option value = "Nepal">Nepal</option>
								<option value = "Netherland Antilles">Netherland Antilles</option>
								<option value = "Netherlands">Netherlands</option>
								<option value = "Nevis">Nevis</option>
								<option value = "New Caledonia">New Caledonia</option>
								<option value = "New Zealand">New Zealand</option>
								<option value = "Nicaragua">Nicaragua</option>
								<option value = "Niger">Niger</option>
								<option value = "Nigeria">Nigeria</option>
								<option value = "Niue">Niue</option>
								<option value = "Norfolk Island">Norfolk Island</option>
								<option value = "North Korea">North Korea</option>
								<option value = "Norway">Norway</option>
								<option value = "Oman">Oman</option>
								<option value = "Pakistan">Pakistan</option>
								<option value = "Palau Island">Palau Island</option>
								<option value = "Palestine">Palestine</option>
								<option value = "Panama">Panama</option>
								<option value = "Papua New Guinea">Papua New Guinea</option>
								<option value = "Paraguay">Paraguay</option>
								<option value = "Peru">Peru</option>
								<option value = "Philippines">Philippines</option>
								<option value = "Pitcairn Island">Pitcairn Island</option>
								<option value = "Poland">Poland</option>
								<option value = "Portugal">Portugal</option>
								<option value = "Puerto Rico">Puerto Rico</option>
								<option value = "Qatar">Qatar</option>
								<option value = "Republic of Montenegro">Republic of Montenegro</option>
								<option value = "Republic of Serbia">Republic of Serbia</option>
								<option value = "Reunion">Reunion</option>
								<option value = "Romania">Romania</option>
								<option value = "Russia">Russia</option>
								<option value = "Rwanda">Rwanda</option>
								<option value = "St. Barthelemy">St. Barthelemy</option>
								<option value = "St. Eustatius">St. Eustatius</option>
								<option value = "St. Helena">St. Helena</option>
								<option value = "St. Kitts-Nevis">St. Kitts-Nevis</option>
								<option value = "St. Lucia">St. Lucia</option>
								<option value = "St. Maarten">St. Maarten</option>
								<option value = "St. Pierre and Miquelon">St. Pierre and Miquelon</option>
								<option value = "St. Vincent and Grenadines">St. Vincent and Grenadines</option>
								<option value = "Saipan">Saipan</option>
								<option value = "Samoa">Samoa</option>
								<option value = "San Marino">San Marino</option>
								<option value = "Sao Tome and Principe">Sao Tome and Principe</option>
								<option value = "Saudi Arabia">Saudi Arabia</option>
								<option value = "Senegal">Senegal</option>
								<option value = "Seychelles">Seychelles</option>
								<option value = "Sierra Leone">Sierra Leone</option>
								<option value = "Singapore">Singapore</option>
								<option value = "Slovakia">Slovakia</option>
								<option value = "Slovenia">Slovenia</option>
								<option value = "Solomon Islands">Solomon Islands</option>
								<option value = "Somalia">Somalia</option>
								<option value = "South Africa">South Africa</option>
								<option value = "South Korea">South Korea</option>
								<option value = "Spain">Spain</option>
								<option value = "Sri Lanka">Sri Lanka</option>
								<option value = "Sudan">Sudan</option>
								<option value = "Suriname">Suriname</option>
								<option value = "Swaziland">Swaziland</option>
								<option value = "Sweden">Sweden</option>
								<option value = "Switzerland">Switzerland</option>
								<option value = "Syria">Syria</option>
								<option value = "Tahiti">Tahiti</option>
								<option value = "Taiwan">Taiwan</option>
								<option value = "Tajikistan">Tajikistan</option>
								<option value = "Tanzania">Tanzania</option>
								<option value = "Thailand">Thailand</option>
								<option value = "Togo">Togo</option>
								<option value = "Tokelau">Tokelau</option>
								<option value = "Tonga">Tonga</option>
								<option value = "Trinidad and Tobago">Trinidad and Tobago</option>
								<option value = "Tunisia">Tunisia</option>
								<option value = "Turkey">Turkey</option>
								<option value = "Turkmenistan">Turkmenistan</option>
								<option value = "Turks and Caicos Islands">Turks and Caicos Islands</option>
								<option value = "Tuvalu">Tuvalu</option>
								<option value = "Uganda">Uganda</option>
								<option value = "United Kingdom">United Kingdom</option>
								<option value = "Ukraine">Ukraine</option>
								<option value = "United Arab Erimates">United Arab Emirates</option>
								<option value = "United States of America" selected>United States of America</option>
								<option value = "Uraguay">Uruguay</option>
								<option value = "Uzbekistan">Uzbekistan</option>
								<option value = "Vanuatu">Vanuatu</option>
								<option value = "Vatican City">Vatican City</option>
								<option value = "Venezuela">Venezuela</option>
								<option value = "Vietnam">Vietnam</option>
								<option value = "British Virgin Islands">British Virgin Islands</option>
								<option value = "U.S. Virgin Islands">U.S. Virgin Islands</option>
								<option value = "Wake Island">Wake Island</option>
								<option value = "Wallis and Futana">Wallis and Futana</option>
								<option value = "Yemen">Yemen</option>
								<option value = "Zaire">Zaire</option>
								<option value = "Zambia">Zambia</option>
								<option value = "Zimbabwe">Zimbabwe</option>
							</select>
						</label>
						<label>
							<input type = "submit" class = "button" name = "save_country" value = "Save" />
						</label>
				<?php
					}
					else //don't display edit button if it has been clicked
					{
				?>
						<label>
							<input type = "submit" class = "button" name = "edit_country" value = "Edit" />
						</label>
				<?php
					}
				?>
			</form>
			<form method = "POST">
				<?php
					if(isset($_POST['edit_country'])) //display cancel button if edit button has been clicked
					{
				?>
						<br><label>
							<input type = "submit" class = "button" name = "cancel_country" value = "Cancel" />
						</label>
				<?php
					}
				?>
			</form>
		</p>

		<?php
			//function for updating data
			function updateData($columnName, $newData, $dbconn)
			{
				$updateQuery = "UPDATE `user_profile` SET `$columnName` = '$newData' WHERE `UPID` = '".$_SESSION['UPID']."'"; //update database
				mysqli_query($dbconn, $updateQuery) or die("Couldn't execute query\n");
		?>
				<script type = "text/javascript">
					document.getElementById("<?php echo $columnName; ?>").innerHTML = "<?php echo $newData; ?>"; //overwrite displayed data with new data
				</script>
		<?php 
			}
			//check for saved data
			if(isset($_POST['save_first_name']))
			{
				updateData("first_name", $_POST['first_name'], $dbconn); //update database
			}
			else if(isset($_POST['save_middle_name']))
			{
				updateData("middle_name", $_POST['middle_name'], $dbconn);
			}
			else if(isset($_POST['save_last_name']))
			{
				updateData("last_name", $_POST['last_name'], $dbconn);
			}
			else if(isset($_POST['save_gender']))
			{
				updateData("gender", $_POST['gender'], $dbconn);
			}
			else if(isset($_POST['save_date_of_birth']))
			{
				updateData("date_of_birth", $_POST['date_of_birth'], $dbconn);
			}
			else if(isset($_POST['save_email']))
			{
				updateData("email", $_POST['email'], $dbconn);
			}
			else if(isset($_POST['save_home_phone_number']))
			{
				updateData("home_phone_number", $_POST['home_phone_number'], $dbconn);
			}
			else if(isset($_POST['save_cell_phone_number']))
			{
				updateData("cell_phone_number", $_POST['cell_phone_number'], $dbconn);
			}
			else if(isset($_POST['save_street_1']))
			{
				updateData("street_1", $_POST['street_1'], $dbconn);
			}
			else if(isset($_POST['save_street_2']))
			{
				updateData("street_2", $_POST['street_2'], $dbconn);
			}
			else if(isset($_POST['save_city']))
			{
				updateData("city", $_POST['city'], $dbconn);
			}
			else if(isset($_POST['save_state']))
			{
				updateData("state", $_POST['state'], $dbconn);
			}
			else if(isset($_POST['save_zip_code']))
			{
				updateData("zip_code", $_POST['zip_code'], $dbconn);
			}
			else if(isset($_POST['save_country']))
			{
				updateData("country", $_POST['country'], $dbconn);
			}
		?>
	</div>

	<!-- Bottom of the page -->
	<div id = "footer">
		<!-- Music controls -->
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
	</div>
</body>     
</html>
