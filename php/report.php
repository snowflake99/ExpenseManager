<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
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

        $selyear = $_GET['year'];

        for ($month = 1; $month <= 12; $month++)    {
            if ($month < 10) $month = "0".$month;
            $table = $usrId."_".$month."_".$selyear."_";
            $sql="SELECT SUM(amount) AS TOTAL FROM $table";

            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                $result=mysql_query($sql);
                $result1=mysql_query("SHOW TABLES LIKE '".$table."'");
                $nRow=mysql_num_rows($result1);
            } else {
                $result=mysqli_query($conn, $sql);
                $result1=mysqli_query($conn, "SHOW TABLES LIKE '".$table."'");
                $nRow=mysqli_num_rows($result1);
            }

            if($nRow != 1)   {
                echo "@$table=0";
            } else {
                while ( ((PHP_VERSION_ID <  $VER_PHP_7_0) && ($row = mysql_fetch_array($result))) ||
                        ((PHP_VERSION_ID >= $VER_PHP_7_0) && ($row = mysqli_fetch_array($result))) ) {
                   echo "@$table=".$row{'TOTAL'};
                }
            }
        }
    }

    include 'closedb.php';

    die();
?>
