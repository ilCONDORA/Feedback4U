<?php
$servername = "localhost";
$database = "feedback4u";
$username = "root";
$password = "password";
$port = 3307;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
echo 'Connected successfully';

?>