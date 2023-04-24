<!-- File name: auth_session.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: Authenticates the session to see if someone is signed in and if they are not they are redirected to the login page ------>
<?php
	session_start();
	if(!isset($_SESSION["loggedin"])) {
		header("Location: login.php");
		exit();
	}
?>
