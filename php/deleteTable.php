<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $tableName   = $_GET['tableName'];

        $sql = "DROP TABLE $tableName";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $retval = mysql_query($sql);
        } else {
            $retval = mysqli_query($conn, $sql);
        }

        if(! $retval )
        {
            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                die('Could not delete table:'.mysql_error());
            } else {
                die('Could not delete table:'.mysqli_error($conn));
            } 
        }
        echo "Table deleted successfully\n";
    }

    include 'closedb.php';

    die();
?>
