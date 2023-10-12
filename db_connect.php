<?php
// Connect to the database
$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "techvibes";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>