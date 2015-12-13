<?php
	$username = $_GET['name'];
	$password = $_GET['password'];
	$hostname = "localhost"; 
	
	//connection to the database
	$dbhandle = mysql_connect($hostname, $username, $password) 
	  or die("Unable to connect to MySQL");

	$selected = mysql_select_db("testdb",$dbhandle) 
	  or die("Could not select examples");

	$result = mysql_query("SELECT Date, Category, Description, Amount FROM _01_2015_");

	while ($row = mysql_fetch_array($result)) {
	   echo "Date=".$row{'Date'}." Category=".$row{'Category'}." Description=".$row{'Description'}." Amount=".$row{'Amount'};

	}	
?>
