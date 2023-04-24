<!--
File: index.php

redirects to login.php page
-->
<?php
    // Start the session.
    session_start();
    // Instead check if the user is logged in and then redirect.
    if (!isset($_SESSION['loggedin'])) {
        header("Location: login.php");
    } else {
	header("Location: main.php");
    }
?>
