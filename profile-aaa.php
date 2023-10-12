<?php
session_start();
// Get the username from the URL parameter
// Loop through all session data
/* foreach ($_SESSION as $key => $value) {
  // Do something with the key and value
  echo "Key: " . $key . " Value: " . $value . "<br>";
} */

$username = $_GET['username'];
//print_r($username);
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
  $telephone = $row['telephone'];
  $address = $row['address'];
  $links = $row['links'];
  $designation = $row['designation'];
  $company = $row['company'];
  $biography = $row['biography'];
  $image_name = $row['image_name'];
  $theme = $row['theme'];
  $this_user = $row['username'];


  echo "<h1>$first_name $last_name's Profile</h1>";
  echo "<p><strong>Email:</strong> $email</p>";
  echo "<p><strong>Phone:</strong> $phone</p>";
  echo "<p><strong>Address:</strong> $address</p>";

  $data = $links;
  $urls = explode(";", $data);

  // Loop through the array and create the desired structure
  foreach ($urls as $url) {
    // Split each URL into its components
    $parts = explode(",", $url);
    $link = $parts[0];
    $type = $parts[1];

    // Add "http://" if the URL doesn't have it already
    if (strpos($link, 'http://') === false && strpos($link, 'https://') === false) {
      $link = "http://" . $link;
    }

    // Create the structured URL string
    //echo "URL;TYPE=" . $type . ":" . $link . "<br>";
    ?>
    <a href="<?php echo $link; ?>" target="_blank">
      <img class="link" src="https://introcardbd.app/images/<?php
      if ($type == "Facebook") {
        echo "link-facebook-dark.svg";
      } elseif ($type == 'Instagram') {
        echo 'link-instagram-dark.svg';
      } elseif ($type == 'LinkedIn') {
        echo 'link-linkedin-dark.svg';
      } elseif ($type == 'YouTube') {
        echo 'link-youtube-dark.svg';
      } elseif ($type == 'Website') {
        echo 'link-link-dark.svg';
      } elseif ($type == 'Pinterest') {
        echo 'link-pinterest-dark.svg';
      } elseif ($type == 'Twitter') {
        echo 'link-twitter-dark.svg';
      } elseif ($type == 'Snapchat') {
        echo 'link-snapchat-dark.svg';
      } elseif ($type == 'Teams') {
        echo 'link-teams-dark.svg';
      }elseif ($type == 'Quora') {
        echo 'link-quora-dark.svg';
      } elseif ($type == 'Tiktok') {
        echo 'link-tiktok-dark.svg';
      } elseif ($type == 'Twitch') {
        echo 'link-twitch-dark.svg';
      } elseif ($type == 'Soundcloud') {
        echo 'link-soundcloud-dark.svg';
      } elseif ($type == 'Vimeo') {
        echo 'link-vimeo-dark.svg';
      } elseif ($type == 'Spotify') {
        echo 'link-spotify-dark.svg';
      } elseif ($type == 'Discord') {
        echo 'link-discord-dark.svg';
      }elseif ($type == 'Behance') {
        echo 'link-behance-dark.svg';
      } elseif ($type == 'Fiverr') {
        echo 'link-fiverr-dark.svg';
      } elseif ($type == 'Dribbble') {
        echo 'link-dribbble-dark.svg';
      } elseif ($type == 'Upwork') {
        echo 'link-upwork-dark.svg';
      }
      ?>"></a>
<?PHP

  }
  echo " <br>";




  $my_links = explode(';', $links);
  print_r($my_links);


  echo "<p><strong>Links:</strong>";
  $single_link = explode(',', $my_links[0]);
  print_r($single_link);
  echo $my_links[0];
  print "<br>";
  print "<br>";
  $my_links_urls = explode(',', $my_links[0]);
  echo count($my_links_urls);
  echo $my_links_urls[0];
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

  //echo " " /* . gettype($links) *. "</p>";
  echo "<p><strong>Designation:</strong> $designation</p>";
  echo "<p><strong>Company:</strong> $company</p>";
  echo "<p><strong>Biography:</strong> $biography</p>";
  echo "<p><strong>telephone:</strong> $telephone</p>";
  echo "<p><strong>Image:</strong> <img src='images/$image_name'></p>";
  echo "<p><strong>Theme:</strong> $theme</p>";

  echo '<a href="../updateinfo.php?username=' .$username.'">Update Information</a>' ;

  $conn->close();
}
