<?php
    session_start();

    $activityTimeoutInMin = (1 * 60);

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        // User is loggin in
        $now = time();
        if ($now > $_SESSION['expire']) {
            // session have expired call logout and redirect to login page
            include 'php/usrLogout.php';
            header("Location: ../login");
        } else {
            // update session new expiry time
            $_SESSION['expire'] = $now + $activityTimeoutInMin;
        }
    } else {
        // User not logged in direct to login page 
        header("Location: ../login"); 
    }
?>
