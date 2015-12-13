<?php
    header("Location: ../home.html"); 

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hostname = "localhost"; 

    $dbhandle = mysql_connect($hostname, "sanjoy","sanjoy") 
      or die("Unable to connect to MySQL");

    $selected = mysql_select_db("testdb",$dbhandle) 
      or die("Could not select examples");

    $result = mysql_query("SELECT username, password FROM usrAuth");

    $success=false;
    while ($row = mysql_fetch_array($result)) {
       if (strcmp ($row{'username'}, $username) == 0 && 
               strcmp ($row{'password'}, $password) == 0) {
        $success=true;
       }
    }

    echo $success;
?>
