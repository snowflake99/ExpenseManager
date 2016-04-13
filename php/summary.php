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

        $sql="SELECT category, SUM(amount) AS total FROM $table GROUP BY category";
        $result=mysql_query($sql);

        while ($row = mysql_fetch_array($result)) {
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
