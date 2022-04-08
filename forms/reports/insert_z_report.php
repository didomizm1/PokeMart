<?php
require_once('../employee_session.php');
//connect to database
include_once('../connect_mysql.php');
//setup query
$query="CREATE EVENT 'daily_report' 
ON SCHEDULE EVERY 1 DAY 
STARTS '2021-04-20 00:00:00:
DO
INSERT INTO 'z_report" ;

?>