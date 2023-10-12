<?php
// Connect to the database
$servername = "localhost";
$dbusername = "techbprc_intro";
$password = "g?NWzSvkfyuc";
$dbname = "techbprc_introcard";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>