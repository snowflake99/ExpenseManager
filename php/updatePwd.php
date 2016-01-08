<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $oldPwd  = md5($_POST['old_pwd']);
        $newPwd1 = md5($_POST['new_pwd1']);
        $newPwd2 = md5($_POST['new_pwd2']);
        $usrName = $_SESSION['username'];

        // Search for unique id for current session username 
        $sql="SELECT id FROM _users WHERE username='$usrName'";
        $result=mysql_query($sql);
        
        while ($row = mysql_fetch_array($result)) {
            $usrId = $row{'id'};
        }

        // If the new password matches with retyped password
        if ($newPwd1 == $newPwd2)   {
            // Fetch old password from table
            $sql = "SELECT password FROM _users WHERE id=$usrId";
            $result=mysql_query($sql);

            while ($row = mysql_fetch_array($result)) {
                $fetchedOldPwd=$row{'password'};
            }

            // If supplied old password and fetched old password matches
            if ($fetchedOldPwd == $oldPwd)  {
                $sql = "UPDATE _users SET password='$newPwd1' WHERE id=$usrId AND BINARY password='$oldPwd'";      
                $result=mysql_query($sql);
     
                if(mysql_affected_rows() != 1)  {
                    $msg='New password update failed! '.mysql_error();
                } else {
                    $msg="New password updated successfully!";
                }
            } else {
                $msg="Old password does not match!";
            } 
        } else {
            $msg="New password does not match!";
        }
    }

    echo $msg;

    include 'closedb.php';

    die();
?>
