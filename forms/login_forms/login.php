<?php

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
                $SCIDQuery = "SELECT `SCID` FROM `shopping_cart` WHERE `CPID` = '".$_SESSION['CPID']."'";
                $SCIDResult = mysqli_query($dbconn, $SCIDQuery) or die("Couldn't execute query\n");
                $row4 = $SCIDResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['SCID'] = $row4['SCID'];

                //save WLID in the session
                $WIDQuery = "SELECT `WID` FROM `wishlist` WHERE `CPID` = '".$_SESSION['CPID']."'";
                $WIDResult = mysqli_query($dbconn, $WIDQuery) or die("Couldn't execute query\n");
                $row5 = $WIDResult->fetch_array(MYSQLI_ASSOC);
                $_SESSION['WID'] = $row5['WID'];

                //save EPID  in the session only if user is an employee
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