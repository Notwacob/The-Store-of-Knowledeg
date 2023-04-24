<!-- File name: cart.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: The sites cart page that will displays the cart information for the user that is currently loged in. ------>

<?php
//include db.php file on all pages that require database access
require('db.php');
//include auth_session.php file on all user panel pages
include("auth_session.php");

$username = $_SESSION["username"];
$password = $_SESSION["password"];

$sum = 0;
if (isset($_POST['up'])) {
    $olid_id = $_POST['input_name'];
    $username = $_SESSION["username"];
    $up_q = "UPDATE cart set quantity=quantity+1 WHERE username='$username' AND edition_id='$olid_id'";
    $up_r = mysqli_query($con, $up_q);
    header("Location: cart.php");    
}

if (isset($_POST['down'])) {
    $olid_id = $_POST['input_name'];
    $username = $_SESSION["username"];
    $down_q = "UPDATE cart set quantity=quantity-1 WHERE username='$username' AND edition_id='$olid_id'";
    $down_r = mysqli_query($con, $down_q);
    header("Location: cart.php");
}

if (isset($_POST['del'])) {
    $olid_id = $_POST['input_name'];
    $username = $_SESSION["username"];
    $del_q = "DELETE FROM cart WHERE username='$username' AND edition_id='$olid_id'";
    $del_r = mysqli_query($con, $del_q);
    header("Location: cart.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Store of Knowledge - Cart</title>
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
    <div class="container-md border cart">
	<div class="row">
	<table>
	    <thead>
		<tr>
		    <th style="width:100px;">Image</th>
		    <th>Title</th>
		    <th>Author</th>
		    <th style="width:40px;">Quantity</th>
		    <th style="width:140px;"></th>
		</tr>
	    </thead>
	    <tbody id="cart-items">
		<?php
		    $username = $_SESSION["username"];
		    $query = "SELECT * FROM cart WHERE username='$username'";
            	    $result = mysqli_query($con, $query);
		    $content = array();
            	    while( $row = mysqli_fetch_assoc($result)){
                	$content[] = $row;
            	    }
		    for ($i = 0; $i < count($content); $i++) {
			$olid_id = $content[$i]['edition_id'];
			$title = $content[$i]['title'];
			$authors = $content[$i]['authors'];
			$quantity = $content[$i]['quantity'];
			$sum = $quantity + $sum;
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
			echo "<tr>";
			    echo "<td><img src='$cover_url' alt='book cover for $title'></td>";
			    echo "<td>$title</td>";
			    echo "<td>$authors</td>";
			    echo "<td>$quantity</td>";
			    echo "<td>";
				echo "<form method='post'>";
				    echo "<input type='hidden' value='$olid_id' name='input_name'>";
				    echo "<button type='submit' class='btn btn-primary' name='up'><i class='fas fa-sort-up'></i></button> ";
				    echo "<button type='submit' class='btn btn-primary' name='down'><i class='fas fa-sort-down'></i></button> "; 
				    echo "<button type='submit' class='btn btn-primary' name='del'><i class='fas fa-times'></i></button>";
				echo "</form>"; 
			    echo "</td>";
			echo "</tr>";
		    }
		?>
	    </tbody>
	    <tfoot>
		<tr>
		    <td colspan="3">Total:</td>
		    <td id="cart-total"><?php echo "$sum"; ?></td>
		    <td>
			<form method="GET" action="https://www.amazon.com/gp/aws/cart/add.html" target="_blank">
			    <input type="hidden" name="AssociateTag" value="Associate Tag" />
			    <?php
				for ($i = 0; $i < count($content); $i++) {
				    $cartValue = $i + 1;
				    $cartBookOlidID = $content[$i]["edition_id"];
				    $cartBookQuantity = $content[$i]["quantity"];
				    $cartBookApi = "https://openlibrary.org/books/".$cartBookOlidID.".json";
				    $cartBookJson = file_get_contents($cartBookApi);
				    $cartBookJsonData = json_decode($cartBookJson,true);
				    $cartBookIsbn = $cartBookJsonData["isbn_10"][0];
				    echo "<input type='text' class='hidden' name='ASIN.$cartValue' value='$cartBookIsbn'>";
				    echo "<input type='text' class='hidden' name='Quantity.$cartValue' value='$cartBookQuantity'>";
				}
			    ?>
			    <input type="submit" class='btn btn-primary w-100' name="add" value="Checkout" />
			</form>
		    </td>
		</tr>
	    </tfoot>
	</table>
	</div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
