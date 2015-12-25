<?php
    include 'config.php';
    include 'opendb.php';
    
    $selmonth = $_GET['month'];
    $selyear = $_GET['year'];
    $table = "_".$selmonth."_".$selyear."_";

    $sql="SELECT edate,category,description,amount FROM $table";
    $result=mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
       echo "@edate=".$row{'edate'}."?category=".$row{'category'}."?description=".$row{'description'}."?amount=".$row{'amount'};
    }

    include 'closedb.php';

    die();
?>
