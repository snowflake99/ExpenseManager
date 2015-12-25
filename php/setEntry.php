<?php
    include 'config.php';
    include 'opendb.php';
    
    $selmonth   = $_GET['month'];
    $selyear    = $_GET['year'];
    $data       = $_GET['rowEntries'];
    $table      = "_".$selmonth."_".$selyear."_";

    if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '".$table."'")) != 1)   {
        // Table does not exist!, create it
        $sql = "create table $table (idx int not null auto_increment, 
                                     edate date not null, 
                                     category int, 
                                     description varchar(255), 
                                     amount int, 
                Primary key(idx))";
    } else {
        $sql = "TRUNCATE TABLE $table";
    }

    $result = mysql_query($sql);

    $result_row=preg_match_all("/([^@]+)/", $data, $matches_row);
    foreach ($matches_row[1] as $recordRow) {
        $idx = 0;
        $elementValue[0] = null;
        $elementValue[1] = null;
        $elementValue[2] = null;
        $elementValue[3] = null;

        $result_col=preg_match_all("/([^?]+)/", $recordRow, $matches_cell);
        foreach ($matches_cell[1] as $recordCell)   {
            $result_value=preg_match_all("/([^=]+$)/", $recordCell, $matches_value);
            foreach ($matches_value[1] as $value)   {
                $elementValue[$idx++] = $value;
            }
        }
        if ($elementValue[0] != null &&
            $elementValue[1] != null &&
            $elementValue[2] != null &&
            $elementValue[3] != null)   {
            $sql = "insert into $table (edate, category, description, amount) 
                                values ('".$elementValue[0]."', 
                                        '".$elementValue[1]."', 
                                        '".$elementValue[2]."',  
                                        '".$elementValue[3]."')";
            $result = mysql_query($sql);
        }
    }

    include 'closedb.php';

    echo "Data Saved $table";

    die();
?>
