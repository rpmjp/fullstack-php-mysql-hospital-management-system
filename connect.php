<?php
$servername = "localhost";
$username = "u611796019_Robroot_";    // example: u611796019_admin
$password = "Robert_911!";    // your actual DB password
$dbname = "u611796019_NMA_Clinic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
