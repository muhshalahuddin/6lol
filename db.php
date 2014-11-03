<?php
//Hostname - normaly localhost
//DBusername - your mysql username
//DBpassword - your mysql password
//DBname - your mysql database name
		$db = new PDO('mysql:host=localhost;dbname=9gag', 'root', 'master753//.');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
