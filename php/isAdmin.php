<?php
    session_start();

    include 'config.php';
    include 'opendb.php';

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sql="SELECT isAdmin FROM _users WHERE username='$_SESSION[username]' AND isAdmin='1'";
        $result=mysql_query($sql);
	 
        $count=mysql_num_rows($result);

        if ($count == 1)	{
            echo "1";
        } else {
            echo "0";
        }
    }

    include 'closedb.php';

    die();
?>
