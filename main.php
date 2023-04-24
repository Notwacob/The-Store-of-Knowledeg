<!-- File name: main.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: The landing page after logining in with an account that was in the users database. displays the top 16 books rated on our site ------>
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
    <title>The Store of Knowledge - Main</title>
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
    <svg style="display:none;">
  	<defs>
            <symbol id="fivestars">
      		<path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd"/>
      		<path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(24)"/>
      		<path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(48)"/>
      		<path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd" transform="translate(72)"/>
      		<path d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z M0 0 h24 v24 h-24 v-24" fill="white" fill-rule="evenodd"  transform="translate(96)"/>
    	    </symbol>
  	</defs>
    </svg>
    <section class="hero">
        <div class="hero-inner">
            <h1>The Store of Knowledge</h1>
	    <?php
		$username = $_SESSION["username"];
		$password = $_SESSION["password"];
		$query = "SELECT firstName, lastName FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
        	$result = mysqli_query($con, $query) or die(mysql_error());
		while($row = mysqli_fetch_array($result)){
    		    echo "<h2>Welcome $row[0] $row[1]</h2>";
		}
	    ?>
        </div>
    </section>
    <?php include("navbar.php"); ?>
    <div class="container-lg">
    <div class="row row-cols-1 row-cols-md-3 g-4">
	<?php
	    $query = "SELECT * FROM bookList ORDER BY Rating DESC, _record_number ASC LIMIT 16";
            $result = mysqli_query($con, $query);
	    $content = array();
    	    while( $row = mysqli_fetch_assoc($result)){
     		$content[] = $row;
	    }
	    for ($i = 0; $i < count($content); $i++) {
		$title = $content[$i]["Title"];
		$author = $content[$i]["Authors"];
		$olid_id = $content[$i]["Edition_ID"];
		$cover_url = "https://covers.openlibrary.org/b/olid/$olid_id-L.jpg?default=false";
		$handle = curl_init($cover_url);
		curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
		/* Get the HTML or whatever is linked in $url. */
		$response = curl_exec($handle);
		/* Check for 404 (file not found). */
		$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		if($httpCode == 404) {
    		    $cover_url = "images/book-cover-placeholder.png";
		}
		curl_close($handle);
		$ratingValue = $content[$i]["Rating"];
		$totalValue = $content[$i]["Total"];
		echo "<div class='col'>";
		    echo "<div class='book card h-100'>";
			echo "<img src='$cover_url' class='card-img-top' alt='book cover for $title'>";
			echo "<div class='card-body'>";
			    echo "<p class='card-text'>";
				echo "<em>$title</em>";
				if (!is_null($author)) {
				    echo " by $author";
				}
			    echo "</p>";
			    echo "<div class='rating'>";
				echo "<progress class='rating-bg' value='$ratingValue' max='5'></progress>";
				echo "<span>";
				    echo "<span style='float: left'><svg><use xlink:href='#fivestars'/></svg></span>";
				    echo "<span style='float: left'>$ratingValue ($totalValue)</span>";
				echo "</span>";
			    echo "</div>";
			echo "</div>";
			echo "<div class='card-footer'>";
			    echo "<form method='post' action='bookRequest.php' class='mainBtnForm'>";
				echo "<input type='hidden' value='$olid_id' name='input_name'>";
                                echo "<input type='hidden' value='$title' name='input_title'>";
                                echo "<input type='hidden' value='$author' name='input_authors'>";
                                echo "<button class='btn btn-primary' type='submit' name='addToCartBtn' style='margin-right: 8px'>Add to Cart</button>";
                                echo "<button class='btn btn-primary' type='submit' name='addToListBtn' style='margin-right: 8px'>Add to List</button>";
                                echo "<button class='btn btn-primary' type='submit' name='reviewBookBtn' style='margin-right: 8px'>Review Book</button>";
			    echo "</form>";
			echo "</div>";
		    echo "</div>";
		echo "</div>";
	    }
	?>
    </div></div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
