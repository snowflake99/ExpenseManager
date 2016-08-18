<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $selmonth = $_GET['month'];
        $selyear = $_GET['year'];
    
        $sql="SELECT id FROM _users WHERE username='$_SESSION[username]'";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
        } else {
            $result=mysqli_query($conn, $sql);
        }

        while ( ((PHP_VERSION_ID <  $VER_PHP_7_0) && ($row = mysql_fetch_array($result))) ||
                ((PHP_VERSION_ID >= $VER_PHP_7_0) && ($row = mysqli_fetch_array($result))) ) {
            $usrId = $row{'id'};
        }

        $table = $usrId."_".$selmonth."_".$selyear."_";

        $sql="SELECT category, SUM(amount) AS total FROM $table GROUP BY category";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
        } else {
            $result=mysqli_query($conn, $sql);
        }

        while ( ((PHP_VERSION_ID <  $VER_PHP_7_0) && ($row = mysql_fetch_array($result))) ||
                ((PHP_VERSION_ID >= $VER_PHP_7_0) && ($row = mysqli_fetch_array($result))) ) {
            if (empty($row{'category'}))
                $category = "Uncategorized";
            else
                $category = $row{'category'}; 

            echo "@category=".$category."?total=".$row{'total'};
        }
    }

    include 'closedb.php';

    die();
?>
