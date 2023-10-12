<?php
// Get the username from the URL parameter
// Loop through all session data
foreach ($_SESSION as $key => $value) {
  // Do something with the key and value
  echo "Key: " . $key . " Value: " . $value . "<br>";
}

$username = $_GET['username'];
print_r($username);
//die;

// Connect to the database
$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "introcard";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query the database for the user's details
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // If the user was found, display their details in HTML
  $row = $result->fetch_assoc();

  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $email = $row['email'];
  $phone = $row['phone'];
  $address = $row['address'];
  $links = $row['links'];
  $designation = $row['designation'];
  $company = $row['company'];
  $biography = $row['biography'];
  $image_name = $row['image_name'];
  $theme = $row['theme'];

  echo "<h1>$first_name $last_name's Profile</h1>";
  echo "<p><strong>Email:</strong> $email</p>";
  echo "<p><strong>Phone:</strong> $phone</p>";
  echo "<p><strong>Address:</strong> $address</p>";

  print_r(explode(';', $links));
  $my_links = explode(';', $links);

  echo "<p><strong>Links:</strong>";
  print_r(explode(',', $my_links[0]));
  echo $my_links[0];
  print "<br>";
  print "<br>";
  $my_links_urls = explode(',', $my_links[0]);
  echo count($my_links_urls);
  echo $my_links_urls[1];
  print "<br>";

  //if($my_links_urls[1] == 'ln'){
  if (!empty($my_links_urls[1])) {
    echo "linkedin <br>";
    print_r($my_links_urls);
    echo "<br>";
    echo gettype($my_links_urls[1]);
    if ($my_links_urls[1] == "ln") {
      echo "varified <br>";
    }
  }

  print "<br>";
  print "<br>";

  echo " " /* . gettype($links) */ . "</p>";
  echo "<p><strong>Designation:</strong> $designation</p>";
  echo "<p><strong>Company:</strong> $company</p>";
  echo "<p><strong>Biography:</strong> $biography</p>";
  echo "<p><strong>Biography:</strong> $image_name</p>";
  echo "<p><strong>Image:</strong> <img src='images/$image_name'></p>";
  echo "<p><strong>Theme:</strong> $theme</p>";
} else {
  // If the user wasn't found, display an error message
  echo "<h1>User Not Found</h1>";
  //print_r($username);
}

$conn->close();
