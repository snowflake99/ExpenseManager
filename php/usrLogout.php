<?php
    session_start();

    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        if ( isset( $_COOKIE[session_name()] ) ) {
            setcookie( session_name(), “”, time()-3600, “/” );
        }
        echo "Killing:".$_SESSION['username'];

        $_SESSION = array();
        session_destroy();
    }
    header("Location: ../login");
?>
