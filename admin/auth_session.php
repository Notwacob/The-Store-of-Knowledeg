<!-- File name: admin/auth_session.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: Authenticates the session to see if someone is signed in and if they are not they are redirected to the login page ------>
<?php
        session_start();
        if(!isset($_SESSION["loggedin"])) {
            header("Location: https://zeus.vwu.edu/~jawilson/CS_489/login.php");
            exit();
        } else if(!isset($_SESSION["adminUser"])) {
	    header("Location: https://zeus.vwu.edu/~jawilson/CS_489/main.php");
            exit();
	}
?>

