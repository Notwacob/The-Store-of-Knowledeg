<?php
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
