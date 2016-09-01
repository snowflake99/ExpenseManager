<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userId   = $_GET['userId'];
        $userName = $_GET['userName'];
        $rights   = $_GET['userRights'];
        $currency = $_GET['userCurrency'];

        if ($userId == 0)   {
            $defaultPwd = md5('password');

            // User does not exist ! Add new user
            $sql="INSERT INTO _users (username, password, isAdmin, currency) VALUES ('$userName','$defaultPwd',$rights,'$currency')";
        } else {
            $sql="UPDATE _users SET username='$userName', isAdmin=$rights, currency='$currency' WHERE id=$userId";
        }

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            if(mysql_query($sql)== false)  {
                die('Could not update user detail: '.mysql_error());
            } else {
                echo "User detail updated";
            }
        } else {
            if(mysqli_query($conn, $sql) == false)  {
                die('Could not update user detail: '.mysqli_error($conn));
            } else {
                echo "User detail updated";
            }
        } 
    }

    include 'closedb.php';

    die();
?>
