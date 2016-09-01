<?php
    if (PHP_VERSION_ID < $VER_PHP_7_0)  {
        mysql_close($conn);
    } else {
        mysqli_close($conn);
    }
?>
