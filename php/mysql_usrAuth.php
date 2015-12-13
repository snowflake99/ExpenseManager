<?php
    header("Location: ../login"); 

    $username = $_POST['username'];
    $password = $_POST['password'];
    $hostname = "localhost";

//    if (!isset($_SESSION['loggedin']))	{
//        session_unset ();
//	session_destroy ();
//	$_SESSION=array();
//
//	echo "Killing:".$_SESSION['username'];
//	 
//    }else{
//	echo "Starting:".$username; 
//    } 

    $dbhandle = mysql_connect($hostname, "sanjoy","sanjoy") 
      or die("Unable to connect to MySQL");

    $selected = mysql_select_db("testdb",$dbhandle) 
      or die("Could not select examples");

    $result = mysql_query("SELECT username, password FROM usrAuth");

    $msg="Login failure";
    while ($row = mysql_fetch_array($result)) {
       if (strcmp ($row{'username'}, $username) == 0 && 
               strcmp ($row{'password'}, $password) == 0) {
	$msg="Login successful";

	session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("Location: ../home"); 
	break;
       }
    }

    echo $msg;

    die();
?>
