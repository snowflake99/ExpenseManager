<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $user = $_GET['user'];

        $sql="SELECT id FROM _users WHERE username='$user'";
        $result=mysql_query($sql);
        
        while ($row = mysql_fetch_array($result)) {
            $usrId = $row{'id'};
        }

        $tableList="";
        for ($year = 2010; $year <= date("Y"); $year++) {
            $yearEntryPrinted=false;
            for ($month = 1; $month <= 12; $month++)   {
                $selMonth = ($month < 10) ? ('0'.$month):$month;
                $table = $usrId."_".$selMonth."_".$year."_";

                if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'")) != 1)   {
                    // Table does not exist!, create it. Do Nothing
                } else {
                    // Table exists
                    if ($yearEntryPrinted == false) {
                        echo "@year=".$year;
                        $yearEntryPrinted=true;
                    }
                    echo "?table=".$table; 
                }
            }
        }
    }

    include 'closedb.php';

    die();
?>
