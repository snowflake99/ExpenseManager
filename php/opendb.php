<?php
    if (PHP_VERSION_ID < $VER_PHP_7_0)  {
        $conn = mysql_connect($dbhost, 
                              $dbuser, 
                              $dbpass) 
        or die ('Error connecting to mysql');

        mysql_select_db($dbname)
        or die ('Error selecting the database');
    } else {
        $conn = mysqli_connect($dbhost, 
                               $dbuser, 
                               $dbpass, 
                               $dbname);
        if (!$conn) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }
?>
