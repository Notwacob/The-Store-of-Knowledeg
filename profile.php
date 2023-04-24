<!-- File name: profile.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: The sites profile page that will displays the profile information for the user that is currently loged in and allow it to be edited. ------>

<?php
session_start();
if(!isset($_SESSION["loggedin"])) {
    header("Location: login.php");
    exit();
} else {
?>
<div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
	<div class="modal-content">
	    <div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Profile</h5>
	    </div>
      	    <div class="modal-body form-login">
	 	<?php            
                    $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
                    $result = mysqli_query($con, $query) or die(mysql_error());
                    $editUsers = array();
                    while($row = mysqli_fetch_array($result)){
                 	$editUsers[] = $row;
                    }
                    $firstName = $editUsers[0]['firstName'];
		    $lastName = $editUsers[0]['lastName'];
		    if (isset($_POST['submitProfile'])) {
			$newUsername = $_POST['username'];
			$newUsername = stripslashes($newUsername);
    			$newUsername = mysqli_real_escape_string($con, $newUsername);
			$newPassword = $_POST['password'];
			$newPassword = stripslashes($newPassword);
    			$newPassword = mysqli_real_escape_string($con, $newPassword);
			$newFirstName = $_POST['firstName'];
			$newLastName = $_POST['lastName'];
			$sql_nu = "SELECT * FROM users WHERE username='$newUsername'";
			$res_nu = mysqli_query($con, $sql_nu);
        		if($newUsername === $username) {
			    $profileUpdate_sql = "UPDATE users SET password='" . md5($newPassword) ."', firstName='$newFirstName', lastName='$newLastName' WHERE username='$username'";
			    $profileUpdate_res = mysqli_query($con, $profileUpdate_sql);
			} else if(mysqli_num_rows($res_nu) > 0) {
			    echo "";
			} else {
			    $profileUpdate_sql = "UPDATE users SET username='$newUsername' password='" . md5($newPassword) ."', firstName='$newFirstName', lastName='$newLastName' WHERE username='$username'";
			    $profileUpdate_res = mysqli_query($con, $profileUpdate_sql);
			}
			header("Refresh:0");
		    }
            	?>
		<script>
		    $(document).ready(function() {
			$("#pictureEdit").hide();
			$("#imgUploadBtn").hide(); 
 			$("#editProfileBtn").click(function() {
			    $("#editProfile").show();
			    $("#editProfileBtn").hide();
  			});
			$("#profileCloseBtn").click(function() {
			    $("#editProfile").hide();
                            $("#editProfileBtn").show();
			});
			
			$("#editUsername").click(function() {
			    parent = $(this).parent();
			    child = parent.children(":first");
			    child.prop('readonly', (i, v) => !v);
			});

			$("#editPassword").click(function() {       
                            parent = $(this).parent();
                            child = parent.children(":first");
			    child.prop('readonly', (i, v) => !v);
                        });

			$("#editFirstName").click(function() {       
                            parent = $(this).parent();
                            child = parent.children(":first");
			    child.prop('readonly', (i, v) => !v);
                        });

			$("#editLastName").click(function() {       
                            parent = $(this).parent();
                            child = parent.children(":first");
			    child.prop('readonly', (i, v) => !v);
                        });
		    });
		</script>
			<div class="row" id="profile">
			    <div class="col-12 text-center mt-1">
				<?php
				    if($username === "admin" || $username === "user") {
					echo "<button type='button' class='btn btn-secondary' id='editProfileBtn' disabled>Edit Profile</button>";	
				    } else {
					echo "<button type='button' class='btn btn-secondary' id='editProfileBtn'>Edit Profile</button>";
				    }
				?>
                                <form class="form" method="post" id="editProfile">
				    <div class="editProfileValue">
				    	<input type="text" name="username" placeholder="Username" <?php echo "value='$username'"; ?> readonly>
					<button type="button" id="editUsername" class="show-password-btn" value="1"><i class="fas fa-edit"></i></button>
				    </div>
				    <div class="editProfileValue">
					<input type="password" name="password" placeholder="Password" id="password-field" <?php echo "value='$password'";?> readonly>
					<button type="button" id="editPassword" class="show-password-btn" value="2"><i class="fas fa-edit"></i></button>
				    </div>
				    <div class="editProfileValue">
				  	<input type="text" name="firstName" placeholder="First Name" <?php echo "value='$firstName'";?> readonly>
					<button type="button" id="editFirstName" class="show-password-btn" value="3"><i class="fas fa-edit"></i></button>
				    </div>
				    <div class="editProfileValue">
					<input type="text" name="lastName" placeholder="Last Name" <?php echo "value='$lastName'";?> readonly>
					<button type="button" id="editLastName" class="show-password-btn" value="4"><i class="fas fa-edit"></i></button>					
				    </div>
				    <input type="submit" id="submitProfile" name="submitProfile" class="hidden"/>
			    	</form>
			    </div>
			</div>
      		    </div>
      		    <div class="modal-footer">
        		<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="profileCloseBtn">Close</button>
        		<button type="button" class="btn btn-primary" id="updateProfile" onclick="document.getElementById('submitProfile').click()">Save changes</button>
      		    </div>
    		</div>
  	    </div>
	</div>
<?php } ?>
