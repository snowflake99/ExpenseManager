<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userId = $_GET['userId'];

        $sql="DELETE FROM _users WHERE id='$userId'";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
        } else {
            $result=mysqli_query($conn, $sql);
        }
 
        if( ((PHP_VERSION_ID <  $VER_PHP_7_0) && (mysql_affected_rows() != 1)) ||
            ((PHP_VERSION_ID >= $VER_PHP_7_0) && (mysqli_affected_rows($conn) != 1)) )  {
            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                die('Could not delete user: '.mysql_error());
            } else
                die('Could not delete user: '.mysqli_error($conn));
        } else {
            echo "User deleted";
        }
    }

    include 'closedb.php';

    die();
?>
