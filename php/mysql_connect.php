<?php
	$username = $_GET['name'];
	$password = $_GET['password'];
	$hostname = "localhost"; 
	
	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password) 
	  or die("Unable to connect to MySQL");

	echo "Connected to MySQL";
?>
