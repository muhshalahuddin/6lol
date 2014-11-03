<?php
$mysqli = new mysqli();
$mysqli->connect('localhost', 'root', 'master753//.', '9gag');

//Hostname - normaly localhost
//DBusername - your mysql username
//DBpassword - your mysql password
//DBname - your mysql database name


if ($mysqli->connect_errno) { echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error; } 

?>
