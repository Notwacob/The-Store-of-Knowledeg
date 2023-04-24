<?php
session_start();
if(!isset($_SESSION["loggedin"])) {
    header("Location: ../login.php");
    exit();
} else {
    require('../db.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Store of Knowledge - Search Api Output</title>
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
    <?php
	include("navbar.php");
	$searchApiInput = $_POST['searchApiInput'];
	$searchApiInput = str_replace(" ", "+", $searchApiInput);
	$searchApiUrl = "https://openlibrary.org/search.json?q=".$searchApiInput;
	$searchApiJson = file_get_contents($searchApiUrl);
	$searchApiJson = json_decode($searchApiJson, true);
	$searchApiJsonLength = 50;
    ?>
    <div class="container-lg cart">
	<div class="row">
	    <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th style="width:140px;"></th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    <?php
			$content = array();
                        for ($i = 0; $i < $searchApiJsonLength; $i++) {
			    $olid_id = $searchApiJson["docs"][$i]["edition_key"][0];
                            $title = $searchApiJson["docs"][$i]["title"];
                            $authors = $searchApiJson["docs"][$i]["author_name"][0];
                            echo "<tr>";
                                echo "<td>$title</td>";
                                echo "<td>$authors</td>";
                                echo "<td>";
                                    echo "<form method='post' action='bookRequest.php'>";
                                        echo "<input type='hidden' value='$olid_id' name='input_name'>";
					echo "<input type='hidden' value='api' name='input_type'>";
					echo "<input type='hidden' value='$title' name='input_title'>";
                                        echo "<input type='hidden' value='$authors' name='input_authors'>";
					echo "<div class='row'>";
                                            echo "<div class='d-grid gap-2 col-12 mx-auto'>";
                                            	echo "<button class='btn btn-primary' type='submit' name='addToCartBtn'>Add to Cart</button>";
                                            	echo "<button class='btn btn-primary' type='submit' name='addToListBtn'>Add to List</button>";
                                            	echo "<button class='btn btn-primary' type='submit' name='reviewBookBtn'>Review Book</button>";
                                            echo "</div>";
					echo "</div>";
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
</body>
</html>
<?php } ?>
