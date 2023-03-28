<?php

// Connect to MySQL
$servername = "localhost";
$username = "root";
$password = "baloocomit1014";
$dbname = "traveldb";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}


?>
