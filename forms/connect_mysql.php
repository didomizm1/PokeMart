<?php

$server = "localhost";
$dbusername = "root";
$password = "";
$db = "pokemart_db";
$debug = "true";

$dbconn = mysqli_connect($server, $dbusername, $password, $db);

if($dbconn->connect_error)
{
    die('Could not connect: ' .$dbconn->connect_error);
}

elseif($debug == "true") 
{
    echo nl2br("\nDEBUG:\n");
    echo nl2br("3 \n 2 \n 1...");
    echo nl2br("\n Connected successfully\n");
}


?>