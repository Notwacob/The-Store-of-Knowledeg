<!-- File name: registration.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: Allows an user to create an account. ------>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Store of Knowledge - Registration</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favison/favicon-16x16.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">
    <script src="https://kit.fontawesome.com/60195d487c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<br>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_POST["submit"])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $firstName = stripslashes($_REQUEST['firstName']);
        $firstName = mysqli_real_escape_string($con, $firstName);
        $lastName = stripslashes($_REQUEST['lastName']);
        $lastName = mysqli_real_escape_string($con, $lastName);
	$loginAttemps = 0;
	$sql_u = "SELECT * FROM users WHERE username='$username'";
        $res_u = mysqli_query($con, $sql_u);
	if(mysqli_num_rows($res_u) > 0) {
    	    echo "<div class='form-login'>
                  <h3>Username already taken try again</h3><br/>
                  <p class='link'><a href='registration.php'>Click here to registration again.</a></p>
                  </div>";
	} else {
    	    $query = "INSERT into `users` (username, password, firstName, lastName, type, loginAttemps) VALUES ('$username', '" . md5($password) . "', '$firstName', '$lastName', 'user', '$loginAttemps')";
    	    $result = mysqli_query($con, $query);
    	    if ($result) {
		echo "<div class='form-login'>
                      <h3>You are registered successfully.</h3><br/>
                      <p class='link'><a href='login.php'>Click here to Login</a></p>
                      </div>";
    	    } else {
		echo "<div class='form-login'>
                      <h3>Required fields are missing.</h3><br/>
                      <p class='link'><a href='registration.php'>Click here to registration again.</a></p>
                      </div>";
    	   }
	}
    } else {
?>
<div class="form-login">
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
	<div class="password-container">
            <input type="password" class="login-input" name="password" placeholder="Password" id="password-field">
	    <button id="show-password-btn" class="show-password-btn"><i class="fas fa-eye-slash"></i></button>
	</div>
        <input type="text" class="login-input" name="firstName" placeholder="First Name">
        <input type="text" class="login-input" name="lastName" placeholder="Last Name">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
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
