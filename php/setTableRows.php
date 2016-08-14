<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $selmonth   = $_POST['month'];
        $selyear    = $_POST['year'];
        $data       = $_POST['rowEntries'];

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

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result = mysql_query("SHOW TABLES LIKE '".$table."'");
            $nRows = mysql_num_rows($result);
        } else {
            $result = mysqli_query($conn, "SHOW TABLES LIKE '".$table."'");
            $nRows = mysqli_num_rows($result);
        }
        
        if($nRows != 1)   {
            // Table does not exist!, create it
            $sql = "create table $table (idx int not null auto_increment, 
                                         edate date not null, 
                                         category varchar(32), 
                                         description varchar(255), 
                                         amount float, 
                    Primary key(idx))";
        } else {
            $sql = "TRUNCATE TABLE $table";
        }

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result = mysql_query($sql);
        } else {
            $result = mysqli_query($conn, $sql);
        }

        // For all the rows in the table
        $result_row=preg_match_all("/([^@]+)/", $data, $matches_row);
        foreach ($matches_row[1] as $recordRow) {
            $idx = 0;
            // For all the cols in the row
            $result_col=preg_match_all("/([^?]+)/", $recordRow, $matches_cell);
            foreach ($matches_cell[1] as $recordCell)   {
                // For all the cols value in the cell
                $result_value=preg_match_all("/([^=]+$)/", $recordCell, $matches_value);
                foreach ($matches_value[1] as $value)   {
                    $elementValue[$idx++] = $value;
                }
            }
            $sql = "insert into $table (edate, category, description, amount) 
                                values ('".$elementValue[0]."', 
                                        '".$elementValue[1]."', 
                                        '".$elementValue[2]."',  
                                        '".$elementValue[3]."')";

            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                $result = mysql_query($sql);
            } else {
                $result = mysqli_query($conn, $sql);
            }
        }
        
        echo "Data Saved $table";
    } else {
        echo "Session Expired !";
    }

    include 'closedb.php';

    die();
?>
