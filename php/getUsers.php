<?php
    session_start();

    include 'config.php';
    include 'opendb.php';

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sql="SELECT * FROM _users";
        $result=mysql_query($sql);
	 
        while ($row = mysql_fetch_array($result)) {
            echo "@id=".$row{'id'}."?username=".$row{'username'}."?isAdmin=".$row{'isAdmin'};
        }
    }

    include 'closedb.php';

    die();
?>
