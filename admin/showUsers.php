<!-- File name: admin/showUsers.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: This is an admin page that shows all users information ------>

<?php
//include db.php file on all pages that require database access
require('../db.php');
//include auth_session.php file on all user panel pages
include("auth_session.php");

$username = $_SESSION["username"];
$password = $_SESSION["password"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Store of Knowledge - Main</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favison/favicon-16x16.png">
    <link rel="manifest" href="../images/favicon/site.webmanifest">
    <script src="https://kit.fontawesome.com/60195d487c.js" crossorigin="anonymous"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type = "text/javascript" src="../function.js"></script>
</head>
<body>
    <?php include("navbar.php"); ?>
    <div class="container-md border cart" id="usersTable">
	<div class="row">
        <table>
	    <thead>
		<tr>
		    <th>Username</th>
		    <th>Password</th>
		    <th>User's Name</th>
		    <th>User Type</th>
		    <th>Login Attemps</th>
		    <th>Last Login Time</th>
		    <th></th>
		</tr>
	    </thead>
	    <tbody id="usersTable-items">
		<?php
		    $query_SU = "SELECT * FROM users";
                    $result_SU = mysqli_query($con, $query_SU);
                    $users = array();
                    while( $row = mysqli_fetch_assoc($result_SU)){
                        $users[] = $row;
                    }
		    for ($i = 0; $i < count($users); $i++) {
			$useridSU = $users[$i]['id'];
			$usernameSU = $users[$i]['username'];
			$passwordSU = $users[$i]['password'];
			$firstNameSU = $users[$i]['firstName'];
			$lastNameSU = $users[$i]['lastName'];
			$userTypeSU = $users[$i]['type'];
			$loginAttempsSU = $users[$i]['loginAttemps'];
			$lastLoginTimeSU = $users[$i]['lastLoginTime'];
			$lastLoginTimeSU = date('d-m-Y h:i:s a', strtotime($lastLoginTimeSU));
			echo "<tr>";
			  echo "<td>$usernameSU</td>";
			  echo "<td>$passwordSU</td>";
			  echo "<td>$firstNameSU $lastNameSU</td>";
			  echo "<td>$userTypeSU</td>";
			  echo "<td>$loginAttempsSU</td>";
			  echo "<td>$lastLoginTimeSU</td>";
			  echo "<td>";
			    echo "<form method='post' action='adminRequest.php'>";
			      echo "<input type='hidden' value='$userTypeSU' name='userType'>";
                              echo "<input type='hidden' value='$useridSU' name='userID'>";
			      if($usernameSU === "admin" || $usernameSU === "user") { 
			        echo "<button type='submit' class='btn btn-primary changeType' name='changeType' disabled>Change Type</button>";
                                echo "<button type='submit' class='btn btn-primary passwordChange' name='passwordChange' disabled>Change Password</button>";
				echo "<button type='submit' class='btn btn-primary' name='deleteUser' disabled><i class='fas fa-times'></i></button>";
                              } else {
			        echo "<button type='submit' class='btn btn-primary changeType' name='changeType'>Change Type</button>";
			        echo "<button type='submit' class='btn btn-primary passwordChange' name='passwordChange'>Change Password</button>";
				echo "<button type='submit' class='btn btn-primary' name='deleteUser'><i class='fas fa-times'></i></button>";
			      }
			    echo "</form>";
			  echo "</td>";
			echo "</tr>";
		    }
		?>
	    </tbody>
	</table>
	</div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
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
