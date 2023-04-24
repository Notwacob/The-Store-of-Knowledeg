<?php
//include db.php file on all pages that require database access
require('db.php');
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Store of Knowledge - Midterm Report</title>
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favison/favicon-16x16.png">
    <link rel="manifest" href="images/favicon/site.webmanifest">
    <script src="https://kit.fontawesome.com/60195d487c.js" crossorigin="anonymous"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type = "text/javascript" src="function.js"></script>
</head>
<body>
    <?php include("navbar.php"); ?>
    <div class="container-lg">
	<div class="row">
	    <iframe src="images/Midterm_Summary.pdf" style="width: 100%; height: 93vh;"></iframe>
	</div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
