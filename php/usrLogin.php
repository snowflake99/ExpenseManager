<?php
    header("Location: ../login"); 

    include 'config.php';
    include 'opendb.php';

    // username and password sent from form 
    $myusername = $_POST['username'];
    $mypassword = $_POST['password'];

    // To protect MySQL injection 
    $myusername = stripslashes($myusername);
    $mypassword = stripslashes($mypassword);
    $myusername = mysql_real_escape_string
                              ($myusername);
    $mypassword = mysql_real_escape_string
                              ($mypassword);
    $sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
    $result=mysql_query($sql);

    // Mysql_num_row is counting table row
    $count=mysql_num_rows($result);

    // If result matched $myusername and $mypassword, 
    // table row must be 1 row
    if($count==1)   {
        session_start();

        $_SESSION['loggedin']   = true;
        $_SESSION['username']   = $myusername;

        header("Location: ../home"); 
    }
    else {
        echo "Wrong Username or Password";
    }

    include 'closedb.php';

    die();
?>
