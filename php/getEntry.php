<?php

    include 'config.php';
    include 'opendb.php';
    
    $selmonth = $_GET['month'];
    $selyear = $_GET['year'];
    $table = "_".$selmonth."_".$selyear."_";

    $sql="SELECT * FROM $table";
    $result=mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
       echo "#Date=".$row{'Date'}."?Category=".$row{'Category'}."?Description=".$row{'Description'}."?Amount=".$row{'Amount'};
    }

    include 'closedb.php';

    die();
?>
