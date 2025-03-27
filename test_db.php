<?php
$conn = new mysqli("localhost", "root", "123456", "se");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
