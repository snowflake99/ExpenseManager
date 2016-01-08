<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $oldPwd  = $_POST['old_pwd'];
        $newPwd1 = $_POST['new_pwd1'];
        $newPwd2 = $_POST['new_pwd2'];
        $usrName = $_SESSION['username'];

        // Search for id for session username 
        $sql="SELECT id FROM _users WHERE username='$usrName'";
        $result=mysql_query($sql);
        
        while ($row = mysql_fetch_array($result)) {
            $usrId = $row{'id'};
        }

        // If the new password match with retyped password
        if ($newPwd1 == $newPwd2)   {
            $sql = "UPDATE _users SET password='$newPwd1' WHERE id=$usrId AND BINARY password='$oldPwd'";      
            $result=mysql_query($sql);
     
            if(mysql_affected_rows() != 1)  {
                $msg='Could not update user detail: '.mysql_error();
            } else {
                $msg="New password updated";
            } 
        } else {
            $msg="New password does not match";
        }
    }

    echo $msg;

    include 'closedb.php';

    die();
?>
