<?php

// Step 1: Set the database connection credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecomstore";

// Step 2: Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>