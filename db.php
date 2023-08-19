<!-- File name: db.php -->
<!-----Author: Jacob Wilson-------->
<!-----Instructor: DR. Wang-------->
<!-----Due: May 1, 2023-------->
<!-----Goal: Contains a connection to the MySQL database to be used by pages that need it. ------>

<?php
        // Enter your host name, database username, password, and database name.

        // If you have not set database password on localhost then set empty.
        $con = mysqli_connect("*********","********","*****","********");
        // Check connection
        if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
?>

