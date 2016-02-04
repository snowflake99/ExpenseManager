<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $selmonth = $_GET['month'];
        $selyear = $_GET['year'];
    
        $sql="SELECT id FROM _users WHERE username='$_SESSION[username]'";
        $result=mysql_query($sql);
        
        while ($row = mysql_fetch_array($result)) {
            $usrId = $row{'id'};
        }

        $table = $usrId."_".$selmonth."_".$selyear."_";

        $sql="SELECT edate,category,description,amount FROM $table";
        $result=mysql_query($sql);

        while ($row = mysql_fetch_array($result)) {
           echo "@edate=".$row{'edate'}."?category=".$row{'category'}."?description=".$row{'description'}."?amount=".$row{'amount'};
        }
    }

    include 'closedb.php';

    die();
?>
