<?php
    session_start();

    include 'config.php';
    include 'opendb.php';

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sql="SELECT * FROM _users";        

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
	 
            while ($row = mysql_fetch_array($result)) {
                echo "@id=".$row{'id'}."?username=".$row{'username'}."?isAdmin=".$row{'isAdmin'}."?currency=".$row{'currency'};
            }
        } else {
            $result=mysqli_query($conn, $sql);
	 
            while ($row = mysqli_fetch_array($result)) {
                echo "@id=".$row{'id'}."?username=".$row{'username'}."?isAdmin=".$row{'isAdmin'}."?currency=".$row{'currency'};
            }
        }
    }

    include 'closedb.php';

    die();
?>
