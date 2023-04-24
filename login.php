<!-- File name: login.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: Allows an user who have an created account to login to that account. ------>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable = no">
    <title>The Store of Knowledge - Login</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favison/favicon-16x16.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">
    <script src="https://kit.fontawesome.com/60195d487c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <script type = "text/javascript" src="function.js"></script>
</head>
<body>
<br>
<?php
    require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['submit'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        // Check user is exist in the database
        $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
	$userInfo = array();
	while(($row =  mysqli_fetch_assoc($result))) {
    	    $userInfo[] = $row;
	}
        if ($rows == 1) {
	    $loginAttemps = $userInfo[0]['loginAttemps'];
	    $loginAttemps = intval($loginAttemps);
	    $loginAttemps++;
	    date_default_timezone_set('America/New_York');
	    $today = date("Y-m-d H:i:s");
            $_SESSION['username'] = $username;
	    $_SESSION['password'] = $password;
	    $_SESSION['loggedin'] = true;
	    $updateQuery = "UPDATE users SET loginAttemps='$loginAttemps', lastLoginTime='$today' WHERE username='$username' AND password='" . md5($password) . "'";
	    $updateResult = mysqli_query($con, $updateQuery);
            // Redirect to user dashboard page
            header("Location: main.php");
        } else {
            echo "<div class='form-login'>
                  <h3>Incorrect Username or Password.</h3>
                  <p class='link'><a href='login.php'>Click here to Login again.</a></p>
                  </div>";
        }
    } else {
?>
<div class="form-login">
    <form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
	<div class="password-container">
            <input type="password" class="login-input" name="password" placeholder="Password" id="password-field"/>
	    <button id="show-password-btn" class="show-password-btn"><i class="fas fa-eye-slash"></i></button>
	</div>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link"><a href="registration.php">Click to Register</a></p>
  </form>
</div>
<?php
    }
?>
<script>
document.getElementById("show-password-btn").addEventListener("click", function() {
  event.preventDefault();
  var passwordField = document.getElementById("password-field");
  var currentType = passwordField.getAttribute("type");
  if (currentType === "password") {
    passwordField.setAttribute("type", "text");
    this.innerHTML = "<i class='fas fa-eye'></i>";
  } else {
    passwordField.setAttribute("type", "password");
    this.innerHTML = "<i class='fas fa-eye-slash'></i>";
  }
});
</script>
</body>
</html>
