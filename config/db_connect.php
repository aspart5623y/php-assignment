<?php
$servername = "localhost";
$username = "root";
$password = "password";
$dbname = "crud_db";
$socket = "/tmp/mysql.sock"; // Path to the MySQL socket file

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, null, $socket);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
