<!-- File name: navbar.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: The sites navigation bar that will be displayed on every page ------>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
    	<a class="navbar-brand" href="main.php">The Store of Knowledge</a>
    	<button class="navbar-toggler collapsed d-flex d-lg-none flex-column justify-contenr-around" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="toggler-icon top-bar"></span>
	    <span class="toggler-icon middle-bar"></span>
	    <span class="toggler-icon bottom-bar"></span>
	</button>
    	    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        	    <li class="nav-item">
          		<a class="nav-link" href="main.php" id="main">Home</a>
        	    </li>
        	    <li class="nav-item">
          		<a class="nav-link" href="about.php" id="about">About</a>
        	    </li>
		    <li class="nav-item">
			<a class="nav-link" href="midterm.php" id="midterm">Midterm Report</a>
		    </li>
	    	<?php
                    $username = $_SESSION["username"];
                    $sql_u = "SELECT * FROM users WHERE username='$username' AND type='admin'";
                    $res_u = mysqli_query($con, $sql_u);
                    if (mysqli_num_rows($res_u) > 0) {
			$_SESSION["adminUser"] = true;
			echo "<li class='nav-item dropdown'>";
			    echo "<a class='nav-link dropdown-toggle' href='#' id='navbarDropdown admin' role='button' data-bs-toggle='dropdown' aria-expanded='false'>";
				echo "Admin";
			    echo "</a>";
			    echo "<ul class='dropdown-menu' aria-labelledby='navbarDropdown'>";
				echo "<li><a class='dropdown-item' href='admin/showUsers.php' id='showUsers'>Show Users</a></li>";
			    echo "</ul>";
			echo "</li>";
            	    }
         	?>
       		<li class="nav-item dropdown">
          	    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown users" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            	        User
          	    </a>
          	    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            		<li><a class="dropdown-item" href="cart.php" id="cart">Cart</a></li>
			<li><a class="dropdown-item" href="wishList.php" id="wishList">Book Wish List</a></li>
            		<li><a class="dropdown-item" href="#editUser" data-bs-toggle="modal" data-bs-target="#editUser" id="profile">Profile</a></li>
            		<li><hr class="dropdown-divider"></li>
            		<li><a class="dropdown-item" href="logout.php">Logout</a></li>
          	    </ul>
		</li>
      	    </ul>
	    <?php include("bookSearch.php"); ?>
	</div>
    </div>
    <?php include("profile.php"); ?>
</nav>
<script>
    function setActive(id) {
	var elementLink = document.getElementById(id);
	elementLink.classList.add('active');
	elementLink.setAttribute("aria-current", "page");
    }
    function setActiveParent(id) {
        var elementLink = document.getElementById(id);
        elementLink.classList.add('active');
    }
</script>
<?php
    $pages = array(
  	           "/~jawilson/CS_489/main.php",
		   "/~jawilson/CS_489/about.php",
		   "/~jawilson/CS_489/cart.php",
		   "/~jawilson/CS_489/admin/showUsers.php",
		   "/~jawilson/CS_489/midterm.php",
		   "/~jawilson/CS_489/wishList.php"
		  );
    $activePageURI = $_SERVER['REQUEST_URI'];
    if($activePageURI === $pages[0]) {
	$id = "main";
    } else if($activePageURI === $pages[1]) {
	$id = "about";
    } else if($activePageURI === $pages[2]) {
	$id = "cart";
	$parentID = "navbarDropdown users";
    } else if($activePageURI === $pages[3]) {
	$id = "showUsers";
	$parentID = "navbarDropdown admin";
    } else if($activePageURI === $pages[4]) {
	$id = "midterm";
    } else if ($activePageURI === $pages[5]) {
	$id = "wishList";
	$parentID = "navbarDropdown users";
    }
?>
<script>
    var id = <?php echo(json_encode($id)); ?>;
    <?php if (!empty($parentID)) { ?>
        var parentID = <?php echo(json_encode($parentID)); ?>;
	setActiveParent(parentID);
    <?php } ?>
    setActive(id);
</script>
