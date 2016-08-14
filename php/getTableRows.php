<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $selmonth = $_GET['month'];
        $selyear = $_GET['year'];
    
        $sql="SELECT id FROM _users WHERE username='$_SESSION[username]'";

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

        $table = $usrId."_".$selmonth."_".$selyear."_";

        $sql="SELECT edate,category,description,amount FROM $table";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);

            while ($row = mysql_fetch_array($result)) {
               echo "@edate=".$row{'edate'}."?category=".$row{'category'}."?description=".$row{'description'}."?amount=".$row{'amount'};
            }
        } else {
            $result=mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_array($result)) {
               echo "@edate=".$row{'edate'}."?category=".$row{'category'}."?description=".$row{'description'}."?amount=".$row{'amount'};
            }
        }
    }

    include 'closedb.php';

    die();
?>
