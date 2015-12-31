<?php
    session_start();

    $activityTimeoutInMin = (20 * 60);

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        // User is loggin in
        $now = time();
        if ($now > $_SESSION['expire']) {
            // session have expired call logout and redirect to login page
	    include 'usrLogout.php';
        } else {
            // update session new expiry time
            $_SESSION['expire'] = $now + $activityTimeoutInMin;
        }
    } else {
        // User not logged in direct to login page 
        header("Location: ../login"); 
    }
?>
