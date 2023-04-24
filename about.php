<!-- File name: about.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: The sites about page that will be have a summary of what the site is used for. ------>

<?php
//include db.php file on all pages that require database access
require('db.php');
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
    <title>The Store of Knowledge - About</title>
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
    <?php include("navbar.php");?>
    <div class="container-lg border">
	<div class="row about">
	    <h1>About Us</h1>
	    <br>
	    <p>Welcome to The Store of Knowledge! We are passionate about books and we believe that reading is an essential part of personal growth, learning and enjoyment. Our goal is to provide you with a wide range of books, covering various genres and subjects, to cater to every interest and reading level.</p>
	    <p>Our team of experienced and knowledgeable book-lovers carefully curates our collection, ensuring that we have the latest bestsellers, classic favorites, and everything in between. We believe that every book has its reader, and we take pride in helping our customers find the perfect book for their needs.</p>
	    <p>We offer competitive prices and fast shipping, so you can enjoy your new book as soon as possible. We also offer a variety of formats, including physical books, eBooks, and audiobooks, to ensure that you can enjoy your reading experience in the way that best suits you.</p>
	    <p>At The Store of Knowledge, we are committed to providing exceptional customer service. Whether you need help finding a specific book or have questions about your order, our friendly and knowledgeable team is always ready to assist you.</p>
	    <p>Thank you for choosing The Store of Knowledge as your go-to source for books. We hope you enjoy browsing our collection and finding your next favorite read.</p>
	</div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
