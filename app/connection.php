<?php
//credenziali docker || NON TOCCARE!!!
$servername = "feedback4u-db-1";
$database = "feedback4u";
$username = "fb4uAdmin";
$password = "fb4uAdminfb4uAdminx2";
$port = 3306;

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database, $port);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
/* echo 'Connected successfully'; */

?>
