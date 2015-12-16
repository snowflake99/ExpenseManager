<?php
    if (!isset($_SESSION['loggedin']))  {
        session_start();

        if ( isset( $_COOKIE[session_name()] ) ) {
            setcookie( session_name(), “”, time()-3600, “/” );
        }
        $_SESSION = array();
        session_destroy();
    
            header("Location: ../login");
     
        echo "Killing:".$_SESSION['username'];
    }
?>
