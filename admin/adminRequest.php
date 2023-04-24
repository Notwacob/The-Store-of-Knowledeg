<!-- File name: admin/adminRequest.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: This is an admin action page that pretains to all admin requests ------>

<?php
//include db.php file on all pages that require database access
require('../db.php');
//include auth_session.php file on all user panel pages
include("auth_session.php");

if (isset($_POST['changeType'])) {
    $userType = $_POST['userType'];
    $userID = $_POST['userID'];
    if($userType === "admin") {
	$query = "UPDATE users SET type='user' WHERE id='$userID'";
    } else if($userType === "user") {
	$query = "UPDATE users SET type='admin' WHERE id='$userID'";
    }
    $result = mysqli_query($con, $query) or die(mysql_error());
    header("Location: showUsers.php");
}

if (isset($_POST['passwordChange'])) {
    $userID = $_POST['userID'];
    echo "<head>";
        echo "<meta charset='utf-8'/>";
    	echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
    	echo "<title>The Store of Knowledge - Admin Request</title>";
    	echo "<link rel='apple-touch-icon' sizes='180x180' href='../images/favicon/apple-touch-icon.png'>";
    	echo "<link rel='icon' type='image/png' sizes='32x32' href='../images/favicon/favicon-32x32.png'>";
    	echo "<link rel='icon' type='image/png' sizes='16x16' href='../images/favison/favicon-16x16.png'>";
    	echo "<link rel='manifest' href='../images/favicon/site.webmanifest'>";
    	echo "<script src='https://kit.fontawesome.com/60195d487c.js' crossorigin='anonymous'></script>";
	echo "<link href='../css/bootstrap.min.css' rel='stylesheet'>";
        echo "<link rel='stylesheet' href='../style.css' type='text/css'>";
        echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js'></script>";
    echo "</head>";
    echo "<body>";
    	echo "<div class='container'>";
	    echo "<div class='row'>";
	    	echo "<div class='col-12 col-md-10 offset-md-1 border'>";
		    echo "<form method='post'>";
		    	echo "<input type='hidden' name='userID' value='$userID'>";
		    	echo "<div class='form-group'>";
    			    echo "<label for='newPassword'>New Password</label>";
    			    echo "<input type='password' class='form-control' id='newPassword' name='newPassword' placeholder='Password'>";
  		    	echo "</div>";
		    	echo "<br>";
		    	echo "<button type='submit' class='btn btn-primary' name='newPasswordBtn'>Submit</button>";
		    echo "</form>";
	    	echo "</div>";
	    echo "</div>";
    	echo "</div>";
    echo "<script src='../js/bootstrap.bundle.min.js'></script>";
    echo "</body>";
}

if (isset($_POST['newPasswordBtn'])) {
    $userID = $_POST['userID'];
    $newPassword = $_POST['newPassword'];
    $newPassword = stripslashes($newPassword);
    $newPassword = mysqli_real_escape_string($con, $newPassword);
    $query = "UPDATE users SET password='". md5($newPassword) ."' WHERE id='$userID'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    header("Location: showUsers.php");
}

if (isset($_POST['deleteUser'])) {
    $userID = $_POST['userID'];
    $query = "DELETE FROM users WHERE id='$userID'";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query) or die(mysql_error());
    $totalUsers = mysqli_num_rows($result);
    $users = array();
    while($rows = mysqli_fetch_assoc($result)){
    	$users[] = $rows;
    }
    for ($i = 0; $i < $totalUsers; $i++) {
	$oldID = $users[$i]['id'];
	$oldID = intval($oldID);
	$newID = $i + 1;
	$query = "UPDATE users SET id='$newID' WHERE id='$oldID'";
	$result = mysqli_query($con, $query) or die(mysql_error());
	if ($i === 4) {
	    $query = "ALTER TABLE users AUTO_INCREMENT = $newID";
	    $result = mysqli_query($con, $query) or die(mysql_error());
	}
    }
    header("Location: showUsers.php");
}
?>
