<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $oldPwd  = $_POST['old_pwd'];
        $newPwd1 = $_POST['new_pwd1'];
        $newPwd2 = $_POST['new_pwd2'];
        $usrName = $_SESSION['username'];

        // Search for unique id for current session username 
        $sql="SELECT id FROM _users WHERE username='$usrName'";

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            $result=mysql_query($sql);
        } else {
            $result=mysqli_query($conn, $sql);
        }

        while ( ((PHP_VERSION_ID <  $VER_PHP_7_0) && ($row = mysql_fetch_array($result))) ||
                ((PHP_VERSION_ID >= $VER_PHP_7_0) && ($row = mysqli_fetch_array($result))) ) {
            $usrId = $row{'id'};
        }

        // If the new password matches with retyped password
        if ($newPwd1 == $newPwd2)   {
            // Fetch old password from table
            $sql = "SELECT password FROM _users WHERE id=$usrId";

            if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                $result=mysql_query($sql);
            } else {
                $result=mysqli_query($conn, $sql);
            }

            while ( ((PHP_VERSION_ID <  $VER_PHP_7_0) && ($row = mysql_fetch_array($result))) ||
                    ((PHP_VERSION_ID >= $VER_PHP_7_0) && ($row = mysqli_fetch_array($result))) ) {
                $fetchedOldPwd=$row{'password'};
            }

            // If supplied old password and fetched old password matches
            if ($fetchedOldPwd == $oldPwd)  {
                $sql = "UPDATE _users SET password='$newPwd1' WHERE id=$usrId AND BINARY password='$oldPwd'";     

                if (PHP_VERSION_ID < $VER_PHP_7_0)  {
                    $result=mysql_query($sql);
                    if(mysql_affected_rows() != 1)  {
                        $msg='New password update failed! '.mysql_error();
                    } else {
                        $msg="New password updated successfully";
                    }
                } else {
                    $result=mysqli_query($conn, $sql);
                    if(mysqli_affected_rows($conn) != 1)  {
                        $msg='New password update failed! '.mysqli_error($conn);
                    } else {
                        $msg="New password updated successfully";
                    }
                }
            } else {
                $msg="Incorrect old password!";
            } 
        } else {
            $msg="Re-typed password does not match!";
        }
    }

    echo $msg;

    include 'closedb.php';

    die();
?>
