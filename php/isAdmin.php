<?php
    session_start();

    include 'config.php';
    include 'opendb.php';

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sql="SELECT isAdmin FROM _users WHERE username='$_SESSION[username]' AND isAdmin='1'";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
            $count=mysql_num_rows($result);
        } else {
            $result=mysqli_query($conn, $sql);
            $count=mysqli_num_rows($result);
        }

        if ($count == 1)	{
            echo "1";
        } else {
            echo "0";
        }
    }

    include 'closedb.php';

    die();
?>
