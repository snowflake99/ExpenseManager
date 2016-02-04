<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $tableName   = $_GET['tableName'];

        $sql = "DROP TABLE $tableName";

        $retval = mysql_query($sql);
        if(! $retval )
        {
            die('Could not delete table:'.mysql_error());
        }
        echo "Table deleted successfully\n";
    }

    include 'closedb.php';

    die();
?>
