<?php
    include 'config.php';
    include 'opendb.php';
    
    $selyear = $_GET['year'];

    for ($month = 1; $month <= 12; $month++)    {
        if ($month < 10) $month = "0".$month;
        $table = "_".$month."_".$selyear."_";
        $sql="SELECT SUM(amount) AS TOTAL FROM $table";
        $result=mysql_query($sql);
       
        while ($row = mysql_fetch_array($result)) {
           echo "@$table=".$row{'TOTAL'};
        }
    }

    include 'closedb.php';

    die();
?>
