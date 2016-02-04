<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $curDate  = $_GET['curDate'];
        $curMonth = $_GET['curMonth'];
        $curYear  = $_GET['curYear'];

        $sql="SELECT id FROM _users WHERE username='$_SESSION[username]'";
        $result=mysql_query($sql);
        
        while ($row = mysql_fetch_array($result)) {
            $usrId = $row{'id'};
        }

        $table = $usrId.'_'.$curMonth.'_'.$curYear.'_';

        $sql="SELECT SUM(amount) AS total FROM $table WHERE edate='$curDate'";
        $result=mysql_query($sql);

        if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'")) != 1)   {
            echo '0';
        } else {
            while ($row = mysql_fetch_array($result)) {
               echo $row{'total'};
            }
        }
    }

    include 'closedb.php';

    die();
?>
