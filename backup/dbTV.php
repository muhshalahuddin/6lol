<?php
$mysqliTV = new mysqli();
$mysqliTV->connect('localhost', 'root', 'master753//.', '9gagTV');

//Hostname - normaly localhost
//DBusername - your mysql username
//DBpassword - your mysql password
//DBname - your mysql database name


if ($mysqliTV->connect_errno) { echo "Failed to connect to MySQL: (" . $mysqliTV->connect_errno . ") " . $mysqliTV->connect_error; } 

?>
