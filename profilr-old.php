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




?>

<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="w4oNFOMyaFe3fKdcwbqkQwG30yM7AUbdR1lAMCf9">
  <script src="../ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="../js/events.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@700&amp;display=swap" rel="stylesheet">
  <link href="../css/app.css" rel="stylesheet">
  <link href="../css/link.css" rel="stylesheet">
  <link href="../css/avatar.css" rel="stylesheet">
  <link href="../css/profile.css" rel="stylesheet">

  <title>Tech Vibes</title>
</head>

<body>
  <div id="wrap">
    <div id="app">
      <div id="theme" class="dark">
        <div id="top">
          <img id="logo" src="../images/TechVibes.png">


          <?php
          /* echo $_SESSION["loggedin"];
          die; */
          if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
          ?>
            <div class="button last" id="button-login" onclick="window.location.href='http://introcardbd.test/menu.html'">Menu</div>
          <?php
          } else {
          ?>
            <div class="button highlight" id="button-shop" onclick="window.location.href='https://techvibesbd.com'">SHOP</div>
            <div class="button last" id="button-login" onclick="window.location.href='http://introcardbd.test/login.php'">LOGIN</div>
          <?php
          }
          ?>


        </div>


        <div id="content">
          <?php
          if ($result->num_rows > 0) {
            // If the user was found, display their details in HTML
            $row = $result->fetch_assoc();

            //print_r($row);

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

            // social links retrieve

            $facebook = $row['Facebook'];
            $facebook_page = $row['Facebook_page'];
            $instagram = $row['Instagram'];
            $linkedin = $row['LinkedIn'];
            $youtube = $row['YouTube'];
            $website = $row['Website'];
            $pinterest = $row['Pinterest'];
            $twitter = $row['Twitter'];
            $snapchat = $row['Snapchat'];
            $teams = $row['Teams'];
            $quora = $row['Quora'];
            $tiktok = $row['Tiktok'];
            $twitch = $row['Twitch'];
            $soundcloud = $row['Soundcloud'];
            $vimeo = $row['Vimeo'];
            $spotify = $row['Spotify'];
            $discord = $row['Discord'];
            $behance = $row['Behance'];
            $fiverr = $row['Fiverr'];
            $dribbble = $row['Dribbble'];
            $upwork = $row['Upwork'];

            /*
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
            } */


            /*
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

            //echo " " /* . gettype($links) *. "</p>";
            echo "<p><strong>Designation:</strong> $designation</p>";
            echo "<p><strong>Company:</strong> $company</p>";
            echo "<p><strong>Biography:</strong> $biography</p>";
            echo "<p><strong>telephone:</strong> $telephone</p>";
            echo "<p><strong>Image:</strong> <img src='images/$image_name'></p>";
            echo "<p><strong>Theme:</strong> $theme</p>";
            */
          ?>

            <div class="card-preview">
              <?php
              if (!empty($image_name)) {
              ?>
                <div id="avatar-wrap">
                  <img id="avatar-img" class="" src="images/<?php echo $image_name; ?>" />
                </div>
              <?php
              }
              ?>

              <div class="right">
                <?php
                if (!empty($first_name) && !empty($last_name)) {
                ?>
                  <div class="title"><?php echo $first_name; ?><br><?php echo $last_name; ?></div>
                <?php
                }
                ?>

                <?php
                if (!empty($designation)) {
                ?>
                  <div class="note"><?php echo $designation; ?> at<br><?php echo $company; ?></div>
                <?php
                }
                ?>

              </div>
            </div>

            <div class="actions">
              <div id="save-contact-button" class="button bordered" onclick="window.location.href='download.php?username=<?php echo $this_user; ?>'">SAVE CONTACT</div>
              <!-- <a href="download.php?username=<?php echo $this_user; ?>&last_name=<?php echo $last_name; ?>&email=<?php echo $email; ?>&phone=<?php echo $phone; ?>&telephone=<?php echo $telephone; ?>" class="btn btn-primary">Download VCF</a>
              -->
              <div id="connect-profile-button" class="button bordered highlight" onclick="window.location.href='https://introcardbd.app/connect/monowar-h.-shuvo'">CONNECT</div>
            </div>


            <div class="links-wrap">

              <img id="button-links-left" src="https://introcardbd.app/icons/left.svg" onclick="links_left()">

              <img id="button-links-right" src="https://introcardbd.app/icons/right.svg" onclick="links_right()">

              <div class="links">

                <?php
                if (!empty($links)) {
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
                      <img class="link" src="../icons/social/<?php
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
                                                              } elseif ($type == 'Quora') {
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
                                                              } elseif ($type == 'Behance') {
                                                                echo 'link-behance-dark.svg';
                                                              } elseif ($type == 'Fiverr') {
                                                                echo 'link-fiverr-dark.svg';
                                                              } elseif ($type == 'Dribbble') {
                                                                echo 'link-dribbble-dark.svg';
                                                              } elseif ($type == 'Upwork') {
                                                                echo 'link-upwork-dark.svg';
                                                              }
                                                              ?>">
                    </a>
                <?php
                  }
                } else echo "There is no links for this User in Database.";
                ?>



              </div>

              <div class="links">
                <?php
                $facebook = $row['Facebook'];
                $facebook_page = $row['Facebook_page'];
                $instagram = $row['Instagram'];
                $linkedin = $row['LinkedIn'];
                $youtube = $row['YouTube'];
                $website = $row['Website'];
                $pinterest = $row['Pinterest'];
                $twitter = $row['Twitter'];
                $snapchat = $row['Snapchat'];
                $teams = $row['Teams'];
                $quora = $row['Quora'];
                $tiktok = $row['Tiktok'];
                $twitch = $row['Twitch'];
                $soundcloud = $row['Soundcloud'];
                $vimeo = $row['Vimeo'];
                $spotify = $row['Spotify'];
                $discord = $row['Discord'];
                $behance = $row['Behance'];
                $fiverr = $row['Fiverr'];
                $dribbble = $row['Dribbble'];
                $upwork = $row['Upwork'];

                if (!empty($facebook)) {
                  echo '<a href="' . $facebook . '" target="_blank"><img class="link" src="../icons/social/link-facebook-dark.svg"></a>';
                }
                if (!empty($website)) {
                  echo '<a href="' . $website . '" target="_blank"><img class="link" src="../icons/social/link-link-dark.svg"></a>';
                }
                if (!empty($facebook_page)) {
                  echo '<a href="' . $facebook_page . '" target="_blank"><img class="link" src="../icons/social/link-facebook-dark.svg"></a>';
                }

                ?>

              </div>

            </div>

            <?php
            if (!empty($biography)) { ?>
              <p style="word-break: break-word;-ms-hyphens: auto;-moz-hyphens: auto;-webkit-hyphens: auto;hyphens: auto;">
                <?php echo $biography; ?>
              </p>
            <?php } ?>


            <!-- $first_name = $row['first_name'];
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
          $theme = $row['theme']; -->

            <?php
            if (!empty($email)) { ?>
              <div class="attributes">
                <div class="attribute">
                  <img class="icon" src="https://introcardbd.app/icons/email.svg">
                  <a class="value" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                  <a class="action" href="mailto:<?php echo $email; ?>">
                    <img class="action" src="https://introcardbd.app/icons/right.svg">
                  </a>

                </div>
              <?php } ?>




              <?php
              if (!empty($phone)) {
              ?>
                <div class="attribute">
                  <img class="icon" src="https://introcardbd.app/icons/phone.svg">
                  <a class="value" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                  <a class="action" href="tel:<?php echo $phone; ?>">
                    <img class="action" src="https://introcardbd.app/icons/right.svg">
                  </a>

                </div>

              <?php
              }
              ?>



              <?php
              if (!empty($telephone)) {
              ?>
                <div class="attribute">
                  <img class="icon" src="https://introcardbd.app/icons/phone.svg">
                  <a class="value" href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?> <span style="font-weight:500">&nbsp(Work)</span></a>
                  <a class="action" href="tel:<?php echo $phone; ?>">
                    <img class="action" src="https://introcardbd.app/icons/right.svg">
                  </a>
                </div>
              <?php
              }
              ?>

              <?php
              if (!empty($address)) {
              ?>
                <div class="attribute">
                  <img class="icon" src="https://introcardbd.app/icons/location.svg">
                  <a class="value" href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo $address; ?>">
                    <?php echo $address; ?>
                  </a>
                  <a class="action" href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo $address; ?>">
                    <img class="action" src="https://introcardbd.app/icons/right.svg">
                  </a>

                </div>
              <?php
              }
              ?>

              </div>
            <?php
          } else {
            // If the user wasn't found, display an error message
            echo "<h1>User Not Found</h1>";
            //print_r($username);
          }

          $conn->close();

            ?>


        </div>
      </div>
    </div>
  </div>
</body>

</html>