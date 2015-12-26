<?php
    include 'config.php';
    include 'opendb.php';
    
    $selmonth = $_GET['month'];
    $selyear = $_GET['year'];
    $table = "_".$selmonth."_".$selyear."_";

    $sql="SELECT category, SUM(amount) AS total FROM $table GROUP BY category";
    $result=mysql_query($sql);

    while ($row = mysql_fetch_array($result)) {
       echo "@category=".$row{'category'}."?total=".$row{'total'};
    }

    include 'closedb.php';

    die();
?>
