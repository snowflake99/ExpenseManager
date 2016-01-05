<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userId = $_GET['userId'];

        $sql="DELETE FROM _users WHERE id='$userId'";
        $result=mysql_query($sql);
     
        if(mysql_affected_rows() != 1)  {
            die('Could not delete user: '.mysql_error());
        } else {
            echo "User deleted";
        } 
    }

    include 'closedb.php';

    die();
?>
