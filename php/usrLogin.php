<?php

    include 'config.php';
    include 'opendb.php';

    // username and password sent from form 
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

    // To protect MySQL injection 
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);

    if (PHP_VERSION_ID < $VER_PHP_7_0)  {
        $myusername = mysql_real_escape_string
                                  ($myusername);
        $mypassword = mysql_real_escape_string
                                  ($mypassword);
    } else {
        $myusername = mysqli_real_escape_string
                                  ($conn, $myusername);
        $mypassword = mysqli_real_escape_string
                                  ($conn, $mypassword);
    }

    $sql="SELECT * FROM $tbl_name WHERE username='$myusername' and BINARY password='$mypassword'";

    if (PHP_VERSION_ID < $VER_PHP_7_0)  {
        $result = mysql_query($sql);
        $count  = mysql_num_rows($result);
    } else {
        $result = mysqli_query($conn, $sql);
        $count  = mysqli_num_rows($result);
    }

    // If result matched $myusername and $mypassword, 
    // table row must be 1 row
    if($count==1)   {
        session_start();

        $_SESSION['loggedin']   = true;
        $_SESSION['username']   = $myusername;
        $_SESSION['start']      = time();
        $_SESSION['expire']     = $_SESSION['start'] + (20 * 60);

        if (PHP_VERSION_ID < $VER_PHP_7_0)  {
            while ($row = mysql_fetch_array($result)) {
                $_SESSION['currency']   = $row{'currency'};
            }
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $_SESSION['currency']   = $row{'currency'};
            }
        }
    
        $msg="Login Successful";
        $redirectURL="Location: ../home";
    }
    else {
        $msg = "Wrong Username or Password";
        $redirectURL="Location: ../login";
    }

    include 'closedb.php';

    $_SESSION['loginMsg']=$msg;

    header($redirectURL);
 
    die();
?>
