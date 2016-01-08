<?php
    session_start();

    include 'config.php';
    include 'opendb.php';
    
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $userId   = $_GET['userId'];
        $userName = $_GET['userName'];
        $rights   = $_GET['userRights'];

        if ($userId == 0)   {
            // User does not exist ! Add new user
            $sql="INSERT INTO _users (username, password, isAdmin) VALUES ('$userName','password',$rights)";
        } else {
            $sql="UPDATE _users SET username='$userName', isAdmin=$rights WHERE id=$userId";
        }
        $result=mysql_query($sql);
     
        if($result == false)  {
            die('Could not update user detail: '.mysql_error());
        } else {
            echo "User detail updated";
        } 
    }

    include 'closedb.php';

    die();
?>
