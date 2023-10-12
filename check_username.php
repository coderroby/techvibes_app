<?php
$username = $_POST['username'];
require_once "db_connect.php";

// Check if the username exists
$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
if (mysqli_num_rows($result) > 0) {
  echo '<span style="color:red">!!!Already exists!!!</span>';
} else {
  echo '<span style="color:white">Available!</span>';
}

// Close the database connection
mysqli_close($conn);
?>
