<?php
// Set up database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "introcard";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Save image to folder and get image name
if ($_FILES['image']['name']) {
  $target_dir = "profile/images/";
  $target_file = $target_dir . basename($_FILES["image"]["name"]);
  move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
  $image_name = $_FILES["image"]["name"];
} else {
  $image_name = "";
}

// Insert data into database
$sql = "INSERT INTO users (email, password, image_name, first_name, last_name) VALUES ('$email', MD5('$password'), '$image_name', '$first_name', '$last_name')";

if ($conn->query($sql) === TRUE) {
  $username = $first_name . $last_name;
  $profile_url = "http://introcardbd.test/profile/" . $username;
  echo "User registered successfully. Profile URL: $profile_url";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
