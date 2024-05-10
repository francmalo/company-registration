<?php

// Database connection details
$servername = "localhost";
$username = "root";
$password = "safaricom";
$database = "business";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}