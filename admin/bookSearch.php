<?php
session_start();
if(!isset($_SESSION["loggedin"])) {
    header("Location: login.php");
    exit();
} else {
?>
<form action="searchOutput.php" method="post" class="d-flex">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchMainInput" id="searchMainInput">
    <button class="btn btn-outline-success" type="submit" id="searchBtn">Search</button>
</form>

<?php } ?>
