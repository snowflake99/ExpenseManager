<?php
    header("Location: ../login"); 

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hostname = "localhost";
    $msg="Login failure";

    $dbhandle = mysql_connect($hostname, $username,$password) 
      or die("Unable to connect to MySQL");

    $selected = mysql_select_db("testdb",$dbhandle) 
      or die("Could not select examples");

    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $username;

    $msg="Login successful";

    header("Location: ../home"); 
    
    echo $msg;

    die();
?>
