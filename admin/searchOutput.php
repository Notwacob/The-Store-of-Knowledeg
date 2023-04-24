<?php
session_start();
if(!isset($_SESSION["loggedin"])) {
    header("Location: ../ogin.php");
    exit();
} else {
    require('../db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Store of Knowledge - Main</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../images/favicon/apple-touch-icon.png">
    <link rel="icon" type="../image/png" sizes="32x32" href="../images/favicon/favicon-32x32.png">
    <link rel="icon" type="../image/png" sizes="16x16" href="../images/favison/favicon-16x16.png">
    <link rel="manifest" href="../images/favicon/site.webmanifest">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type = "text/javascript" src="../function.js"></script>
</head>
<body>
    <?php
        include("navbar.php");
        $searchMainInput = $_POST['searchMainInput'];
	$query = "SELECT * FROM bookList WHERE (title LIKE '%$searchMainInput%' OR authors LIKE '%$searchMainInput%')";
	$result = mysqli_query($con, $query) or die(mysql_error());
    ?>
    <div class="container-lg cart">
        <div class="row">
	    <table>
		<thead>
                    <tr>
                    	<th style="width:100px;">Image</th>
                    	<th>Title</th>
                    	<th>Author</th>
                    	<th style="width:140px;"></th>
                    </tr>
		</thead>
            	<tbody id="cart-items">
		    <?php
			$content = array();
                    	while($row = mysqli_fetch_assoc($result)){
                            $content[] = $row;
                    	}
			for ($i = 0; $i < count($content); $i++) {
			    $olid_id = $content[$i]['Edition_ID'];
                            $title = $content[$i]['Title'];
                            $authors = $content[$i]['Authors'];
			    $cover_url = "https://covers.openlibrary.org/b/olid/$olid_id-L.jpg?default=false";
                	    $handle = curl_init($cover_url);
                	    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
                	    /* Get the HTML or whatever is linked in $url. */
                	    $response = curl_exec($handle);
                	    /* Check for 404 (file not found). */
                	    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                	    if($httpCode == 404) {
                    		$cover_url = "../images/book-cover-placeholder.png";
                	    }
                	    curl_close($handle);
			    echo "<tr>";
                            	echo "<td><img src='$cover_url' alt='book cover for $title'></td>";
                            	echo "<td>$title</td>";
                            	echo "<td>$authors</td>";
                            	echo "<td>";
                                    echo "<form method='post' action='../bookRequest.php'>";
                                    	echo "<input type='hidden' value='$olid_id' name='input_name'>";
					echo "<input type='hidden' value='$title' name='input_title'>";
					echo "<input type='hidden' value='$authors' name='input_authors'>";
					echo "<div class='d-grid gap-2 col-12 mx-auto'>";
					    echo "<button class='btn btn-primary' type='submit' name='addToCartBtn'>Add to Cart</button>";
                                            echo "<button class='btn btn-primary' type='submit' name='addToListBtn'>Add to List</button>";
                                            echo "<button class='btn btn-primary' type='submit' name='reviewBookBtn'>Review Book</button>";
					echo "</div>";
                                    echo "</form>";
                            	echo "</td>";
			    echo "</tr>";
			}
		    ?>
		</tbody>
	    </table>
	    <div class="row">
		<div class="col-12"><br></div>
		<div class="col-md-6 offset-md-3">
		    <h3 class="center">Help Us Grow Our Collection: Search for Books to Add to Our Database</h3>
		    <form action="searchApiOutput.php" method="post" class="d-flex">
    			<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchApiInput" id="searchApiInput">
    			<button class="btn btn-outline-success" type="submit" id="searchApiBtn">Search</button>
		    </form>
		</div>
	    </div>
        </div>
    </div>
    <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php } ?>
