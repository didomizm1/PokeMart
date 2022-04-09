<?php
	//database connection
	include_once('../connect_mysql.php');

    //session handling
	require_once('../employee_session.php');

	//function for updating data
	function updateData($tableName, $columnName, $newData, $tableID, $thisID, $dbconn)
	{
?>
		<script type = "text/javascript">
			<?php
				$updateQuery = "UPDATE `$tableName` SET `$columnName` = '$newData' WHERE `$tableID` = '$thisID'"; //update database
				mysqli_query($dbconn, $updateQuery) or die("Couldn't execute query\n");
				if($columnName !== "user_role_type") //most cases
				{
			?>
					document.getElementById("<?php echo $columnName; ?>").value = "<?php echo $newData; ?>"; //overwrite displayed data with new data
			<?php
				}
				else //special case for user_role_type
				{
					if($newData == 0) //determine if employee info should be removed
					{
						$findEmployeeQuery = "SELECT `EPID` FROM `employee_profile` WHERE `UPID` = '$thisID'";
						$findEmployeeResult = mysqli_query($dbconn, $findEmployeeQuery) or die("Couldn't execute query\n");
						$findEmployeeRow = $findEmployeeResult->fetch_array(MYSQLI_ASSOC);

						if($findEmployeeRow != null) //if employee info exists, remove it
						{
							$deleteEmployeeQuery = "DELETE FROM `employee_profile` WHERE `EPID` = '".$findEmployeeRow['EPID']."'";
							mysqli_query($dbconn, $deleteEmployeeQuery) or die("Couldn't execute query\n");
						}
					}
					
					$array3 = [0 => "Customer", 1 => "Employee", 2 => "Admin"];
			?>
					document.getElementById("<?php echo $columnName; ?>").value = "<?php echo $array3[$newData]; ?>"; //overwrite displayed data with new data
			<?php
				}
			?>
			alert("Profile data successfully changed.")
		</script>
<?php 
	}
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
		</form>
			<p> <!-- Displays info related to a user and allows for editing -->
				<?php
					$row1;
					$row2;
					$row3;
					if(isset($_POST['searchSubmit']) || isset($_SESSION['usernameSearch']))
					{
						$username;
						if(isset($_POST['searchSubmit'])) //check if a new username has been searched
						{
							//search was used, so take username from the search bar and save it for later use in the session
							$username = $_POST['search'];
							$_SESSION['usernameSearch'] = $username;
						}
						else
						{
							//search was used but is not currently set, so use searched username which was saved in the session to automatically update displayed form data after pressing a "save" button
							$username = $_SESSION['usernameSearch'];
						}

						//get ULID associated with entered username
						$query1 = "SELECT `ULID` FROM `user_login` WHERE `username` = '$username'";
						$result1 = mysqli_query($dbconn, $query1) or die("Couldn't execute query\n");
						$row1 = $result1->fetch_array(MYSQLI_ASSOC);

						if($row1 != null) //if username was found, display data
						{
							//get user profile data from ULID
							$query2 = "SELECT * FROM `user_profile` WHERE `ULID` = '".$row1['ULID']."'";
							$result2 = mysqli_query($dbconn, $query2) or die("Couldn't execute query\n");
							$row2 = $result2->fetch_array(MYSQLI_ASSOC);

							if($_SESSION['user_role_type'] > $row2['user_role_type'] || $_SESSION['ULID'] == $row1['ULID']) //only allow a user to view the profile data of a searched user with a lesser user_role_type than them, unless it is their own account
							{
				?>
								<br><h2 id = "header1"><?php echo $username; ?>'s User Data</h2><br>

								<h3 id = "header">User Info</h3>
								<form method = "POST">
									<p> <!-- Username -->
										<label class = "displayInfo"> Username:
											<input type = "text" id = "username" readonly value = "<?php echo $username; ?>" /> 
										</label>
										<label class = "enterInfo"> New username:
											<input type = "text" name = "usernameInput" minlength = "6" maxlength = "32" pattern = "^[a-zA-Z\d_]+$" title = "Username must be at least 6 characters long and may only contain numbers, letters, and/or underscores." required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "usernameSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- User Role Type -->
										<?php
											//array for role type values
											$array = [0 => "Customer", 1 => "Employee", 2 => "Admin", 3 => "Owner"]; 
										?>
										<label class = "displayInfo"> User role type:
											<input type = "text" id = "user_role_type" readonly value = "<?php echo $array[$row2['user_role_type']]; ?>" /> 
										</label>
										<?php
											if($_SESSION['user_role_type'] > 1 && $row2['user_role_type'] != 3) //ensure the user is at least an admin and the searched account does not have the owner user_role_type
											{
										?>
												<label class = "enterInfo"> New user role type:
													<select name = "user_role_typeInput">
														<option value = "0">Customer</option>
														<option value = "1">Employee</option>
														<?php
															if($_SESSION['user_role_type'] > 2) //ensure user is an owner
															{
														?>
																<option value = "2">Admin</option>
														<?php
															} //no option for owner is needed since there will only ever be a single owner account
														?>
													</select> 
												</label>
												<label class = "submitInfo">
													<input type = "submit" name = "user_role_typeSubmit" value = "Save" title = "Save new data" />
												</label>
										<?php
											}
										?>
									</p><br>
								</form>

								<h3 id = "header">Personal Details</h3>
								<form method = "POST">
									<p> <!-- First Name -->
										<label class = "displayInfo"> First name:
											<input type = "text" id = "first_name" readonly value = "<?php echo $row2['first_name']; ?>" /> 
										</label>
										<label class = "enterInfo"> New first name:
											<input type = "text" name = "first_nameInput" maxlength = "50" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "first_nameSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Middle Name -->
										<label class = "displayInfo"> Middle name:
											<input type = "text" id = "middle_name" readonly value = "<?php echo $row2['middle_name']; ?>" /> 
										</label>
										<label class = "enterInfo"> New middle name:
											<input type = "text" name = "middle_nameInput" maxlength = "50" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "middle_nameSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Last Name -->
										<label class = "displayInfo"> Last name:
											<input type = "text" id = "last_name" readonly value = "<?php echo $row2['last_name']; ?>" /> 
										</label>
										<label class = "enterInfo"> New last name:
											<input type = "text" name = "last_nameInput" maxlength = "50" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "last_nameSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Gender -->
										<label class = "displayInfo"> Gender:
											<input type = "text" id = "gender" readonly value = "<?php echo $row2['gender']; ?>" /> 
										</label>
										<label class = "enterInfo"> New gender:
											<input type = "radio" name  = "genderInput" value = "Male" /> Male
											<input type = "radio" name  = "genderInput" value = "Female" /> Female
											<input type = "radio" name  = "genderInput" value = "Other" /> Other
											<input type = "radio" name = "genderInput" value = "None" checked /> Prefer not to say
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "genderSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Date of Birth -->
										<label class = "displayInfo"> Date of birth:
											<input type = "text" id = "date_of_birth" readonly value = "<?php echo $row2['date_of_birth']; ?>" /> 
										</label>
										<label class = "enterInfo"> New date of birth:
											<input type = "date" name = "date_of_birthInput" maxlength = "50" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "date_of_birthSubmit" value = "Save" title = "Save new data" />
										</label>
									</p><br>
								</form>

								<h3 id = "header">Contact Info</h3>
								<form method = "POST">
									<p> <!-- E-mail -->
										<label class = "displayInfo"> E-mail:
											<input type = "text" id = "email" readonly value = "<?php echo $row2['email']; ?>" /> 
										</label>
										<label class = "enterInfo"> New e-mail:
											<input type = "email" name = "emailInput" placeholder = "name@mail.com" maxlength = "100" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "emailSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Home Phone Number -->
										<label class = "displayInfo"> Home phone number:
											<input type = "text" id = "home_phone_number" readonly value = "<?php echo $row2['home_phone_number']; ?>" /> 
										</label>
										<label class = "enterInfo"> New home phone number:
											<input type = "tel" name  = "home_phone_numberInput" placeholder = "123-456-7890" pattern = "[0-9]{3}-[0-9]{3}-[0-9]{4}" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "home_phone_numberSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Cell Phone Number -->
										<label class = "displayInfo"> Cell phone number:
											<input type = "text" id = "cell_phone_number" readonly value = "<?php echo $row2['cell_phone_number']; ?>" /> 
										</label>
										<label class = "enterInfo"> New home phone number:
											<input type = "tel" name  = "cell_phone_numberInput" placeholder = "123-456-7890" pattern = "[0-9]{3}-[0-9]{3}-[0-9]{4}" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "cell_phone_numberSubmit" value = "Save" title = "Save new data" />
										</label>
									</p><br>
								</form>

								<h3 id = "header">Address</h3>
								<form method = "POST">
									<p> <!-- Street Address 1 -->
										<label class = "displayInfo"> Street address 1:
											<input type = "text" id = "street_1" readonly value = "<?php echo $row2['street_1']; ?>" /> 
										</label>
										<label class = "enterInfo"> New street address 1:
											<input type = "text" name = "street_1Input" maxlength = "100" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "street_1Submit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Street Address 2 -->
										<label class = "displayInfo"> Street address 2:
											<input type = "text" id = "street_2" readonly value = "<?php echo $row2['street_2']; ?>" /> 
										</label>
										<label class = "enterInfo"> New street address 2:
											<input type = "text" name = "street_2Input" maxlength = "100" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "street_2Submit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- City -->
										<label class = "displayInfo"> City:
											<input type = "text" id = "city" readonly value = "<?php echo $row2['city']; ?>" /> 
										</label>
										<label class = "enterInfo"> New city:
											<input type = "text" name = "cityInput" maxlength = "100" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "citySubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- State -->
										<label class = "displayInfo"> State <em>(if applicable)</em>:
											<input type = "text" id = "state" readonly value = "<?php echo $row2['state']; ?>" /> 
										</label>
										<label class = "enterInfo"> New state:
											<select name = "stateInput">
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
										<label class = "submitInfo">
											<input type = "submit" name = "stateSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>
								
								<form method = "POST">
									<p> <!-- Zip Code -->
										<label class = "displayInfo"> Zip code:
											<input type = "text" id = "zip_code" readonly value = "<?php echo $row2['zip_code']; ?>" /> 
										</label>
										<label class = "enterInfo"> New zip code:
											<input type = "text" name = "zip_codeInput" minlength = "5" maxlength = "10" pattern = "^[A-Z\d]+$" required /> 
										</label>
										<label class = "submitInfo">
											<input type = "submit" name = "zip_codeSubmit" value = "Save" title = "Save new data" />
										</label>
									</p>
								</form>

								<form method = "POST">
									<p> <!-- Country -->
										<label class = "displayInfo"> Country:
											<input type = "text" id = "country" readonly value = "<?php echo $row2['country']; ?>" /> 
										</label>
										<label class = "enterInfo"> New country:
											<select name = "countryInput">
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
										<label class = "submitInfo">
											<input type = "submit" name = "countrySubmit" value = "Save" title = "Save new data" />
										</label>
									</p><br>
								</form>
				<?php
								if($row2['user_role_type'] > 0) //check if a searched user is an employee
								{
									//get employee profile data from UPID
									$query3 = "SELECT * FROM `employee_profile` WHERE `UPID` = '".$row2['UPID']."'";
									$result3 = mysqli_query($dbconn, $query3) or die("Couldn't execute query\n");
									$row3 = $result3->fetch_array(MYSQLI_ASSOC);
				?>
									<h3 id = "header">Employee Info</h3>
									<form method = "POST">
										<p> <!-- Position -->
											<label class = "displayInfo"> Position:
												<input type = "text" id = "position" readonly value = "<?php echo $row3['position']; ?>" /> 
											</label>
											<label class = "enterInfo"> New position:
												<input type = "text" name = "positionInput" maxlength = "50" required /> 
											</label>
											<label class = "submitInfo">
												<input type = "submit" name = "positionSubmit" value = "Save" title = "Save new data" />
											</label>
										</p>
									</form>

									<!--
									<form method = "POST">
										<p>	Full Time (comment this)
											<?php
												//array for full time values
												//$array2 = [0 => "Part-time", 1 => "Full-time"]; 
											?>
											<label class = "displayInfo"> Full-time status:
												<input type = "text" id = "full_time" readonly value = "<?php //echo $array2[$row3['full_time']]; ?>" /> 
											</label>
											<label class = "enterInfo"> New full-time status:
												<input type = "radio" name = "full_timeInput" value = "1" /> Full-time
												<input type = "radio" name = "full_timeInput" value = "0" checked /> Part-time 
											</label>
											<label class = "submitInfo">
												<input type = "submit" name = "full_timeSubmit" value = "Save" title = "Save new data" />
											</label>
										</p>
									</form>
									-->

									<form method = "POST">
										<p> <!-- Salary -->
											<label class = "displayInfo"> Salary: 
												$ <input type = "text" id = "salary" readonly value = "<?php echo $row3['salary']; ?>" /> 
											</label>
											<label class = "enterInfo"> New salary: 
												$ <input type = "number" name = "salaryInput" required /> 
											</label>
											<label class = "submitInfo">
												<input type = "submit" name = "salarySubmit" value = "Save" title = "Save new data" />
											</label>
										</p><br>
									</form>
				<?php
								}
							}
							else //display error message stating access is not allowed
							{
				?>
								<h2 id = "header">You do not have permission to access <?php echo $username; ?>'s profile.</h2>
				<?php 
							}
						}
						else //if user does not exist, display an error message
						{
				?>
							<h2 id = "header">User "<?php echo $username; ?>" not found. Try again.</h2>
				<?php 
						}
					}
					//user login data
					if(isset($_POST['usernameSubmit']))
					{
						updateData("user_login", "username", $_POST['usernameInput'], "ULID", $row1['ULID'], $dbconn); //update database
						$_SESSION['usernameSearch'] = $_POST['usernameInput']; //update session variable with new username
				?>
						<script type = "text/javascript">
							document.getElementById("header1").innerHTML = "<?php echo $_POST['usernameInput']; ?>'s User Data"; //display new username on the page
						</script>
				<?php
					}
					//user profile data
					else if(isset($_POST['user_role_typeSubmit']))
					{
						updateData("user_profile", "user_role_type", $_POST['user_role_typeInput'], "UPID", $row2['UPID'], $dbconn); //update database

						if($_POST['user_role_typeInput'] > 0) //check for entry in employee profile table if user role type was increased from customer
						{
							$query4 = "SELECT `EPID` FROM `employee_profile` WHERE `UPID` = '".$row2['UPID']."'";
							$result4 = mysqli_query($dbconn, $query4) or die("Couldn't execute query\n");
							$row4 = $result4->fetch_array(MYSQLI_ASSOC);

							if($row4 == null) //create new employee entry if it has not already been created
							{
								$query5 = "INSERT INTO `employee_profile` (`UPID`) VALUES ('".$row2['UPID']."')";
								mysqli_query($dbconn, $query5) or die("Couldn't execute query\n");
							}
						}
					}
					else if(isset($_POST['first_nameSubmit']))
					{
						updateData("user_profile", "first_name", $_POST['first_nameInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['middle_nameSubmit']))
					{
						updateData("user_profile", "middle_name", $_POST['middle_nameInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['last_nameSubmit']))
					{
						updateData("user_profile", "last_name", $_POST['last_nameInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['genderSubmit']))
					{
						updateData("user_profile", "gender", $_POST['genderInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['date_of_birthSubmit']))
					{
						updateData("user_profile", "date_of_birth", $_POST['date_of_birthInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['emailSubmit']))
					{
						updateData("user_profile", "email", $_POST['emailInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['home_phone_numberSubmit']))
					{
						updateData("user_profile", "home_phone_number", $_POST['home_phone_numberInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['cell_phone_numberSubmit']))
					{
						updateData("user_profile", "cell_phone_number", $_POST['cell_phone_numberInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['street_1Submit']))
					{
						updateData("user_profile", "street_1", $_POST['street_1Input'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['street_2Submit']))
					{
						updateData("user_profile", "street_2", $_POST['street_2Input'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['citySubmit']))
					{
						updateData("user_profile", "city", $_POST['cityInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['stateSubmit']))
					{
						updateData("user_profile", "state", $_POST['stateInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['zip_codeSubmit']))
					{
						updateData("user_profile", "zip_code", $_POST['zip_codeInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					else if(isset($_POST['countrySubmit']))
					{
						updateData("user_profile", "country", $_POST['countryInput'], "UPID", $row2['UPID'], $dbconn); //update database
					}
					//employee data
					else if(isset($_POST['positionSubmit']))
					{
						updateData("employee_profile", "position", $_POST['positionInput'], "EPID", $row3['EPID'], $dbconn); //update database
					}
					/*else if(isset($_POST['full_timeSubmit']))
					{
						updateData("employee_profile", "full_time", $_POST['full_timeInput'], "EPID", $row3['EPID'], $dbconn); //update database
					}*/
					else if(isset($_POST['salarySubmit']))
					{
						updateData("employee_profile", "salary", $_POST['salaryInput'], "EPID", $row3['EPID'], $dbconn); //update database
					}
				?>
			</p>
	</div>

	<!-- Bottom of the page -->
	<div id = "footer">
		<!-- Music controls -->
		<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
	</div>
</body>     
</html>
