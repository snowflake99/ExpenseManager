<?php
    header("Location: ../login"); 

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hostname = "localhost"; 

    $dbhandle = mysql_connect($hostname, "sanjoy","sanjoy") 
      or die("Unable to connect to MySQL");

    $selected = mysql_select_db("testdb",$dbhandle) 
      or die("Could not select examples");

    $result = mysql_query("SELECT username, password FROM usrAuth");

    $msg="Login failure";
    $success=false;
    while ($row = mysql_fetch_array($result)) {
       if (strcmp ($row{'username'}, $username) == 0 && 
               strcmp ($row{'password'}, $password) == 0) {
	$msg="Login successful";
        header("Location: ../home"); 
        $success=true;
	break;
       }
    }
    
    if ($success == true)	{
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    } 

    echo $msg;

    die();
?>
