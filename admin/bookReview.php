<!-- File name: bookReview.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: This is a page that is a form for reviewing books ------>

<?php
//include db.php file on all pages that require database access
require('../db.php');
//include auth_session.php file on all user panel pages
include("auth_session.php");

$username = $_SESSION["username"];
$password = $_SESSION["password"];
$olid_id = $_SESSION["olid_id"];
$title = $_SESSION["title"];
$author = $_SESSION["author"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Store of Knowledge - Book Review</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favison/favicon-16x16.png">
    <link rel="manifest" href="../images/favicon/site.webmanifest">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type = "text/javascript" src="../function.js"></script>
</head>
<body>
    <?php include("navbar.php"); ?>
    <div class="container-md cart border">
	<div class="row">
	    <div class="col-12"><br></div>
	    <div class="col-lg-8 offset-lg-2 border">
            	<h2 class="center"><?php echo "$title by $author"; ?></h2>
            	<form method="post" action="bookRequest.php">
		    <?php
			echo "<input type='hidden' value='$olid_id' name='input_name'>";
                        echo "<input type='hidden' value='$title' name='input_title'>";
                        echo "<input type='hidden' value='$author' name='input_authors'>";
		    ?>
	    	    <label for="rating" class="form-label">Rating - <text id="spanscale" style="inline">1</text></label>
	    	    <input type="range" class="form-range" min="0.5" max="5" step="0.5" value="1" id="rating" name="rating">
		    <button type="submit" class="btn btn-primary" name="ratingBtn">Submit</button>
            	</form>
	    </div>
	</div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("rating").oninput = function() {
            document.getElementById("spanscale").innerHTML = this.value;
        }
    </script>
</body>
</html>

