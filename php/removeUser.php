<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userId = $_GET['userId'];

        $sql="DELETE FROM _users WHERE id='$userId'";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
     
            if(mysql_affected_rows() != 1)  {
                die('Could not delete user: '.mysql_error());
            } else {
                echo "User deleted";
            }
        } else {
            $result=mysqli_query($conn, $sql);
     
            if(mysqli_affected_rows($conn) != 1)  {
                die('Could not delete user: '.mysqli_error($conn));
            } else {
                echo "User deleted";
            }
        } 
    }

    include 'closedb.php';

    die();
?>
