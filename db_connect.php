<?php
$servername = "localhost";
$username = "root"; // Change this if using a different user
$password = "";
$dbname = "appointment_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
