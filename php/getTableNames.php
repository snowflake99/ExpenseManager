<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user = $_GET['user'];

        $sql="SELECT id FROM _users WHERE username='$user'";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
            while ($row = mysql_fetch_array($result)) {
                $usrId = $row{'id'};
            }
        } else {
            $result=mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
                $usrId = $row{'id'};
            }
        }

        $tableList="";
        for ($year = 2010; $year <= date("Y"); $year++) {
            for ($month = 1; $month <= 12; $month++)   {
                $selMonth = ($month < 10) ? ('0'.$month):$month;
                $table = $usrId."_".$selMonth."_".$year."_";

                if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                    $result = mysql_query("SHOW TABLES LIKE '".$table."'");
                    $nRow = mysql_num_rows($result);
                } else {
                    $result = mysqli_query($conn, "SHOW TABLES LIKE '".$table."'");
                    $nRow = mysqli_num_rows($result);
                }

                if($nRow != 1)   {
                    // Table does not exist!, Do Nothing
                } else {
                    // Table exists
                    
                    if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                        $result = mysql_query("SELECT COUNT(1) FROM $table");
                        $row = mysql_fetch_array($result);
                    } else {
                        $result = mysqli_query($conn, "SELECT COUNT(1) FROM $table");
                        $row = mysqli_fetch_array($result);
                    }

                    echo "@table=".$table."?rows=".$row[0]; 
                }
            }
        }
    }

    include 'closedb.php';

    die();
?>
