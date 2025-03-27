<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "se";

// Create connection using Object-Oriented method
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>