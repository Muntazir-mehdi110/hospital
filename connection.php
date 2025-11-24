<?php
$servername = "localhost";
$username = "root";  
$password = ""; 
$dbname = "care_database"; 



$database = mysqli_connect($servername, $username, $password, $dbname);

if (!$database) {
    echo "error:" . mysqli_error($database);
};
?>

