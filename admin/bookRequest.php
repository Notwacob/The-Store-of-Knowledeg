<!-- File name: bookRequest.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: This is a page that is an action page for the forms on this site that deal with addin books to a cart and wishlist and reviewing books ------>

<?php
session_start();
if(!isset($_SESSION["loggedin"])) {
    header("Location: ../login.php");
    exit();
} else {
    require('../db.php');
    $username = $_SESSION["username"];
    
    if (isset($_POST['addToCartBtn'])) {
	$olid_id = $_POST['input_name'];
	$title = $_POST['input_title'];
	$author = $_POST['input_authors'];
    	if (isset($_POST['input_type'])) {
	    $query = "SELECT * FROM bookList WHERE Title='$title' AND Authors='$author'";
	    $result = mysqli_query($con, $query) or die(mysql_error());
	    if (mysqli_num_rows($result) == 0) {
		$apiUrl = "https://openlibrary.org/books/".$olid_id.".json";
		$apiJson = file_get_contents($apiUrl);
		$apiJson = json_decode($apiJson, true);
		$publishDate = $apiJson["publish_date"];
		$work_id = $apiJson["works"][0]["key"];
		$work_id = trim($work_id, "/works/");
		$query = "INSERT INTO bookList (Work_ID, Title, Authors, First_Publish_Year, Edition_ID, Rating, Total) VALUES ('$work_id', '$title', '$author', '$publishDate', '$olid_id', 0, 0)";
		$result = mysqli_query($con, $query) or die(mysql_error());
		$query_val = "SELECT quantity FROM `cart` WHERE username='$username' AND edition_id='$olid_id'";
            	$result_val = mysqli_query($con, $query_val) or die(mysql_error());
            	$quantity = 1;
                if (mysqli_num_rows($result_val) > 0) {
                    $quantitys = array();
                    while($row = mysqli_fetch_assoc($result_val)){
                        $quantitys[] = $row;
                    }
                    $quatnity = $quantitys[0]['quantity'];
                    $quantity = (int)$quantity;
                    $quantity++;
                    $cart_q = "UPDATE cart SET quantity='$quantity' WHERE username='$username' AND edition_id='$olid_id'";
            	} else {
                    $cart_q = "INSERT INTO cart (username, edition_id, title, authors, quantity) VALUES ('$username', '$olid_id', '$title', '$author', '$quantity')";
            	}
            	$cart_r = mysqli_query($con, $cart_q) or die(mysql_error());
	    }
    	} else {
	    $query_val = "SELECT quantity FROM `cart` WHERE username='$username' AND edition_id='$olid_id'";
    	    $result_val = mysqli_query($con, $query_val) or die(mysql_error());
    	    $quantity = 1;
    	    if (mysqli_num_rows($result_val) > 0) {              
        	$quantitys = array();
        	while($row = mysqli_fetch_assoc($result_val)){    
            	    $quantitys[] = $row;
        	}
        	$quatnity = $quantitys[0]['quantity'];
        	$quantity = (int)$quantity;
        	$quantity++;
       	 	$cart_q = "UPDATE cart SET quantity='$quantity' WHERE username='$username' AND edition_id='$olid_id'";
    	    } else {
        	$cart_q = "INSERT INTO cart (username, edition_id, title, authors, quantity) VALUES ('$username', '$olid_id', '$title', '$author', '$quantity')";
    	    }
    	    $cart_r = mysqli_query($con, $cart_q) or die(mysql_error());
    	}
	header("Location: ../cart.php");
    }

    if (isset($_POST['addToListBtn'])) {
	$olid_id = $_POST['input_name'];
        $title = $_POST['input_title'];
        $author = $_POST['input_authors'];
        if (isset($_POST['input_type'])) { 
            $query = "SELECT * FROM bookList WHERE Title='$title' AND Authors='$author'";
            $result = mysqli_query($con, $query) or die(mysql_error());
            if (mysqli_num_rows($result) == 0) {
                $apiUrl = "https://openlibrary.org/books/".$olid_id.".json";
                $apiJson = file_get_contents($apiUrl);
                $apiJson = json_decode($apiJson, true);
                $publishDate = $apiJson["publish_date"];
                $work_id = $apiJson["works"][0]["key"];
                $work_id = trim($work_id, "/works/");
                $query = "INSERT INTO bookList (Work_ID, Title, Authors, First_Publish_Year, Edition_ID, Rating, Total) VALUES ('$work_id', '$title', '$author', '$publishDate', '$olid_id', 0, 0)";
                $result = mysqli_query($con, $query) or die(mysql_error());
	    }
	    $q1 = "INSERT INTO wishList (username, edition_id, title, authors) VALUES ('$username', '$olid_id', '$title', '$author')";
            $r1 = mysqli_query($con, $q1) or die(mysql_error());
        } else { 
            $query = "INSERT INTO wishList (username, edition_id, title, authors) VALUES ('$username', '$olid_id', '$title', '$author')";
	    $result = mysqli_query($con, $query) or die(mysql_error());
        }
	header("Location: ../wishList.php");
    }

    if (isset($_POST['reviewBookBtn'])) {
	$olid_id = $_POST['input_name'];
        $title = $_POST['input_title'];
        $author = $_POST['input_authors'];
        if (isset($_POST['input_type'])) { 
            $query = "SELECT * FROM bookList WHERE Title='$title' AND Authors='$author'";
            $result = mysqli_query($con, $query) or die(mysql_error());
            if (mysqli_num_rows($result) == 0) {
                $apiUrl = "https://openlibrary.org/books/".$olid_id.".json";
                $apiJson = file_get_contents($apiUrl);
                $apiJson = json_decode($apiJson, true);
                $publishDate = $apiJson["publish_date"];
                $work_id = $apiJson["works"][0]["key"];
                $work_id = trim($work_id, "/works/");
                $query = "INSERT INTO bookList (Work_ID, Title, Authors, First_Publish_Year, Edition_ID, Rating, Total) VALUES ('$work_id', '$title', '$author', '$publishDate', '$olid_id', 0, 0)";
                $result = mysqli_query($con, $query) or die(mysql_error());
            }
        }
	$_SESSION["olid_id"] = $olid_id;
	$_SESSION["title"] = $title;
	$_SESSION["author"] = $author;
	header("Location: bookReview.php");
    }

    if (isset($_POST['ratingBtn'])) {
	$olid_id = $_POST['input_name'];
        $title = $_POST['input_title'];
        $author = $_POST['input_authors'];
	$rating = $_POST['rating'];
	$rating = floatval($rating);
	unset($_SESSION["olid_id"]);
	unset($_SESSION["title"]);
	unset($_SESSION["author"]);
	$query = "SELECT * FROM bookList WHERE Edition_ID='$olid_id'";
	$result = mysqli_query($con, $query) or die(mysql_error());
	$values = array();
        while($row = mysqli_fetch_assoc($result)){
            $values[] = $row;
        }
	$total = $values[0]["Total"];
	$total = intval($total);
	++$total;
	$oldRating = $values[0]["Rating"];
	$oldRating = floatval($oldRating);
	$newRating = ($oldRating + $rating)/$total;
	$query = "UPDATE bookList SET Rating=$newRating, Total=$total WHERE Edition_ID='$olid_id'";
	$result = mysqli_query($con, $query) or die(mysql_error());
	header("Location: ../main.php");
    }
}
?>

