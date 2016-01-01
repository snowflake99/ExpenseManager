<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $sql="SELECT id FROM _users WHERE username='$_SESSION[username]'";
        $result=mysql_query($sql);
        
        while ($row = mysql_fetch_array($result)) {
            $usrId = $row{'id'};
        }

        $selyear = $_GET['year'];

        for ($month = 1; $month <= 12; $month++)    {
            if ($month < 10) $month = "0".$month;
            $table = $usrId."_".$month."_".$selyear."_";
            $sql="SELECT SUM(amount) AS TOTAL FROM $table";
            $result=mysql_query($sql);

            if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'")) != 1)   {
                   echo "@$table=0";
            } else {
                while ($row = mysql_fetch_array($result)) {
                   echo "@$table=".$row{'TOTAL'};
                }
            }
        }
    }

    include 'closedb.php';

    die();
?>
