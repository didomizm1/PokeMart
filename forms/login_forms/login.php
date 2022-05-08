<?php
    //Matthew DiDomizio
    
    //session handling
	require_once('../no_session.php');

    //saves info about a user's login attempt to the database
    function login_log($ULID, $success, $date, $log, $dbconn)
    {
        $logQuery = "INSERT INTO `user_login_log` (`ULID`, `is_success`, `login_time`, `login_description`) VALUES ('$ULID', '$success', '$date', '$log')";
        mysqli_query($dbconn, $logQuery) or die("Couldn't execute query\n");
    }

    if(isset($_POST['submit']))
    {
        //connect to database
        include_once('../connect_mysql.php');

        //prepare to fetch login data
        $query = "SELECT * FROM `user_login` WHERE `username` = '".$_POST['username']."'";
        
        //store results and place into associative array
        $result = mysqli_query($dbconn, $query) or die("Couldn't execute query\n");
        $row = $result->fetch_array(MYSQLI_ASSOC);

        //verify password and rehash if necessary
        if($row != null) //username exists
        {
            $inputPassword = $_POST['password'];
            $storedPassword = $row['password'];

            //get current date and time
            date_default_timezone_set("America/New_York");
            $date = date("Y-m-d H:i:s");

            if(password_verify($inputPassword, $storedPassword)) //correct password
            {
                if(password_needs_rehash($storedPassword, PASSWORD_DEFAULT)) //update password if needed
                {
                    $newHashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);
                    $updatePassQuery = "UPDATE `user_login` SET `password` = '$newHashedPassword' WHERE `username` = '".$_POST['username']."'";
                    mysqli_query($dbconn, $updatePassQuery) or die("Couldn't execute query\n");
                }
                
                //start new session
                session_start();

                //save info about login to login log
                login_log($row['ULID'], 1, $date, "User successfully logged in at " . $date, $dbconn);
                
                //save ULID in the session
                $ULIDQuery = "SELECT `ULID` FROM `user_login` WHERE `username` = '".$_POST['username']."'";
                $ULIDResult = mysqli_query($dbconn, $ULIDQuery) or die("Couldn't execute query\n");
                $row1 = $ULIDResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['ULID'] = $row1['ULID'];

                //save UPID and user_role_type in the session
                $UPIDQuery = "SELECT `UPID`, `user_role_type` FROM `user_profile` WHERE `ULID` = '".$_SESSION['ULID']."'";
                $UPIDResult = mysqli_query($dbconn, $UPIDQuery) or die("Couldn't execute query\n");
                $row2 = $UPIDResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['UPID'] = $row2['UPID'];
                $_SESSION['user_role_type'] = $row2['user_role_type'];

                //save CPID in the session
                $CPIDQuery = "SELECT `CPID` FROM `customer_profile` WHERE `UPID` = '".$_SESSION['UPID']."'";
                $CPIDResult = mysqli_query($dbconn, $CPIDQuery) or die("Couldn't execute query\n");
                $row3 = $CPIDResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['CPID'] = $row3['CPID'];

                //save SCID in the session
                $SCIDQuery = "SELECT `SCID`, `number_of_items` FROM `shopping_cart` WHERE `CPID` = '".$_SESSION['CPID']."'";
                $SCIDResult = mysqli_query($dbconn, $SCIDQuery) or die("Couldn't execute query\n");
                $row4 = $SCIDResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['SCID'] = $row4['SCID'];

                //only allow checkout if user has items in their cart
                if($row4['number_of_items'] > 0)
                {
                    $_SESSION['canCheckout'] = true;
                }

                //save WLID in the session
                $WIDQuery = "SELECT `WID` FROM `wishlist` WHERE `CPID` = '".$_SESSION['CPID']."'";
                $WIDResult = mysqli_query($dbconn, $WIDQuery) or die("Couldn't execute query\n");
                $row5 = $WIDResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['WID'] = $row5['WID'];

                //save EPID in the session only if user is an employee
                if($_SESSION['user_role_type'] > 0)
                {
                    $EPIDQuery = "SELECT `EPID` FROM `employee_profile` WHERE `UPID` = '".$_SESSION['UPID']."'";
                    $EPIDResult = mysqli_query($dbconn, $EPIDQuery) or die("Couldn't execute query\n");
                    $row6 = $EPIDResult->fetch_array(MYSQLI_ASSOC);
                    $_SESSION['EPID'] = $row6['EPID'];
                }

                //send user to the home page
                header("Location: ../home_page/index.php");
            }
            else //incorrect password; sends the user back to the previous page to re-enter password
            {
                //save info about login to login log
                login_log($row['ULID'], 0, $date, "User unsuccessfully logged in at " . $date, $dbconn);

                echo "<script> alert('Incorrect password entered'); window.history.go(-1); </script>";
                exit();
            }
        }
        else //incorrect username; sends the user back to the previous page to re-enter username
        {
            echo "<script> alert('Username does not exist'); window.history.go(-1); </script>";
            exit();
        }

    }

?>

<!DOCTYPE html>
<html>  
<head>  
    <title>Login</title>
	<!-- Style -->
	<link rel = "stylesheet" href = "login.css">
</head>  
<body>
	<!-- Center of the page -->
	<div id = "mid">
		<!-- Site images -->
		<a href = "../home_page/index.php">
			<img id = "logo" src = "../../img/lnt/logo.png" alt = "PokeMart">
		</a>
		<img id = "tree1" src = "../../img/lnt/tree.png" alt = "PokeTree">
		<img id = "tree2" src = "../../img/lnt/tree.png" alt = "PokeTree">
		<img id = "clouds1" src = "../../img/lnt/clouds.png" alt = "PokeClouds">
		<img id = "clouds2" src = "../../img/lnt/clouds.png" alt = "PokeClouds">
		<img id = "clouds3" src = "../../img/lnt/clouds.png" alt = "PokeClouds">
		<img id = "clouds4" src = "../../img/lnt/clouds.png" alt = "PokeClouds">
		<img id = "clouds5" src = "../../img/lnt/clouds.png" alt = "PokeClouds">
		<img id = "squirtle" src = "../../img/lnt/squirtle.gif" alt = "Squirtle"> 
		<img id = "charmander" src = "../../img/lnt/charmander.gif" alt = "Charmander">
	</div>

	<!-- Log in form -->
	<div id = "form">   
		<h1>Log in to Pok&eacuteMart</h1>  
		<form action = "login.php" method = "POST">
			<!-- Login info -->
			<p>
				<label> Username: 
					<input type = "text" name  = "username" minlength = "6" maxlength = "32" pattern = "^[a-zA-Z\d_]+$" autocomplete autofocus required />
				</label>  
			</p>
			<p>
				<label> Password: 
					<input type = "password" name  = "password" minlength = "8" maxlength = "256" pattern = "^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[^\s]+$" required />
				</label>
			</p>

			<!-- Submit data -->
			<p>
				<input type =  "submit" id = "submit" name = "submit" value = "Login" />
			</p>

			<!-- Link to registration -->
			<footer>Don't have an account? <a id = "link" href="../registration_forms/registration.php">Click here to register!</a></footer>
			<br>

			<!-- Music to be played on the page -->
			<audio id = "audio" src = "../../audio/music/pokemart_soul_silver_theme.mp3" loop controls></audio>
			
		</form>
	</div> 
</body>     
</html>
