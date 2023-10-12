<?php
session_start();
//die;
// Get the username from the URL parameter
$username = $_GET['username'];
// $test = $_GET['test'];
// $test1 = $_GET['lang'];
// echo $username . $test1 . $test;

// // echo '<pre>'.print_r($_SERVER['REQUEST_URI'], TRUE).'</pre>';
// die;



/* print_r($_SESSION);
die; */

require_once 'db_connect.php';

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
  $whatsapp = $row['whatsapp'];
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
//   if(!empty($spotify)){
//       echo $spotify;
//       die;
//   }
  
  $discord = $row['Discord'];
  $behance = $row['Behance'];
  $fiverr = $row['Fiverr'];
  $dribbble = $row['Dribbble'];
  $upwork = $row['Upwork'];
  $wechat = $row['Wechat'];
  
  if ($theme == 'Dark') {
  $profile_css_link = 'profile.css';
  //echo $theme;
  }
  else{
  $profile_css_link = 'profile_light.css';
  //echo $theme;
  }
}

else{
  $profile_css_link = 'profile.css';
  //echo $theme;
}

require_once 'head.php';
?>
<link href="../css/app.css" rel="stylesheet">
<link href="../css/link.css" rel="stylesheet">
<link href="../css/avatar.css" rel="stylesheet">
<link href="../css/<?php echo $profile_css_link ?>" rel="stylesheet">

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
            <div class="button last" id="button-login" onclick="window.location.href='../menu.php'">Menu</div>
          <?php
          } else {
          ?>
            <div class="button highlight" id="button-shop" onclick="window.location.href='https://techvibesbd.com'">SHOP</div>
            <div class="button last" id="button-login" onclick="window.location.href='../login.php'">LOGIN</div>
          <?php
          }
          ?>


        </div>


        <div id="content">
          <?php
          if (!empty($result->num_rows > 0)) {


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
              <?php
              if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
              ?>
                <div id="save-contact-button" class="button bordered" onclick="window.location.href='../updateinfo/<?php echo $this_user; ?>'">Edit Profile</div>
                <div id="connect-profile-button" class="button bordered highlight" onclick="window.location.href='../connect_list/<?php echo $_SESSION['username']; ?>'">My Connects</div>
              <?php
              } else {
              ?>
                <div id="save-contact-button" class="button bordered" onclick="window.location.href='../download/<?php echo $this_user; ?>'">SAVE CONTACT</div>
                <div id="connect-profile-button" class="button bordered highlight" onclick="window.location.href='/connect/<?php echo $this_user; ?>'">CONNECT</div>

              <?php
              }
              ?>
            </div>

            <div class="links-wrap">

              <img id="button-links-left" src="../icons/left.svg" onclick="links_left()">

              <img id="button-links-right" src="../icons/right.svg" onclick="links_right()">

              <div class="links">
                <?php
                if (!empty($facebook)) {
                  echo '<a href="' . $facebook . '" target="_blank"><img class="link" src="../icons/social/link-facebook-dark.png"></a>';
                }
                if (!empty($website)) {
                  echo '<a href="' . $website . '" target="_blank"><img class="link" src="../icons/social/link-link-dark.png"></a>';
                }
                if (!empty($facebook_page)) {
                  echo '<a href="' . $facebook_page . '" target="_blank"><img class="link" src="../icons/social/21.png"></a>';
                }

                if (!empty($linkedin)) {
                  echo '<a href="' . $linkedin . '" target="_blank"><img class="link" src="../icons/social/link-linkedin-dark.png"></a>';
                }
                if (!empty($instagram)) {
                  echo '<a href="' . $instagram . '" target="_blank"><img class="link" src="../icons/social/link-instagram-dark.png"></a>';
                }
                if (!empty($youtube)) {
                  echo '<a href="' . $youtube . '" target="_blank"><img class="link" src="../icons/social/link-youtube-dark.png"></a>';
                }
                if (!empty($pinterest)) {
                  echo '<a href="' . $pinterest . '" target="_blank"><img class="link" src="../icons/social/link-pinterest-dark.png"></a>';
                }
                if (!empty($twitter)) {
                  echo '<a href="' . $twitter . '" target="_blank"><img class="link" src="../icons/social/link-twitter-dark.png"></a>';
                }
                if (!empty($snapchat)) {
                  echo '<a href="' . $snapchat . '" target="_blank"><img class="link" src="../icons/social/link-snapchat-dark.png"></a>';
                }
                if (!empty($teams)) {
                  echo '<a href="' . $teams . '" target="_blank"><img class="link" src="../icons/social/link-teams-dark.png"></a>';
                }
                if (!empty($quora)) {
                  echo '<a href="' . $quora . '" target="_blank"><img class="link" src="../icons/social/link-quora-dark.png"></a>';
                }
                if (!empty($tiktok)) {
                  echo '<a href="' . $tiktok . '" target="_blank"><img class="link" src="../icons/social/link-tiktok-dark.png"></a>';
                }
                if (!empty($twitch)) {
                  echo '<a href="' . $twitch . '" target="_blank"><img class="link" src="../icons/social/link-twitch-dark.png"></a>';
                }
                if (!empty($soundcloud)) {
                  echo '<a href="' . $soundcloud . '" target="_blank"><img class="link" src="../icons/social/link-soundcloud-dark.png"></a>';
                }
                if (!empty($vimeo)) {
                  echo '<a href="' . $vimeo . '" target="_blank"><img class="link" src="../icons/social/link-vimeo-dark.png"></a>';
                }
                if (!empty($spotify)) {
                  echo '<a href="' . $spotify . '" target="_blank"><img class="link" src="../icons/social/link-spotify-dark.png"></a>';
                }
                if (!empty($discord)) {
                  echo '<a href="' . $discord . '" target="_blank"><img class="link" src="../icons/social/link-discord-dark.png"></a>';
                }
                if (!empty($behance)) {
                  echo '<a href="' . $behance . '" target="_blank"><img class="link" src="../icons/social/link-behance-dark.png"></a>';
                }
                if (!empty($fiverr)) {
                  echo '<a href="' . $fiverr . '" target="_blank"><img class="link" src="../icons/social/link-fiverr-dark.png"></a>';
                }
                if (!empty($dribbble)) {
                  echo '<a href="' . $dribbble . '" target="_blank"><img class="link" src="../icons/social/link-dribbble-dark.png"></a>';
                }
                if (!empty($upwork)) {
                  echo '<a href="' . $upwork . '" target="_blank"><img class="link" src="../icons/social/link-upwork-dark.png"></a>';
                }
                if (!empty($wechat)) {
                  echo '<a href="' . $wechat . '" target="_blank"><img class="link" src="../icons/social/link-wechat-dark.png"></a>';
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
            <?php
            if (!empty($email)) { ?>
              <div class="attributes">
                <div class="attribute">
                  <img class="icon" src="../icons/Mail.svg">
                  <a class="value" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                  <a class="action" href="mailto:<?php echo $email; ?>">
                    <img class="action" src="../icons/right.svg">
                  </a>

                </div>
              <?php } ?>




              <?php
              if (!empty($phone)) {
              ?>
                <div class="attribute">
                  <img class="icon" src="../icons/Call.svg">
                  <a class="value" href="tel:<?php echo $phone; ?>"><?php echo $phone; ?></a>
                  <a class="action" href="tel:<?php echo $phone; ?>">
                    <img class="action" src="../icons/right.svg">
                  </a>

                </div>

              <?php
              }
              ?>
              
              <?php
              if (!empty($telephone)) {
              ?>
                <div class="attribute">
                  <img class="icon" src="../icons/Call.svg">
                  <a class="value" href="tel:<?php echo $telephone; ?>"><?php echo $telephone; ?> <span style="font-weight:500">&nbsp(Work)</span></a>
                  <a class="action" href="tel:<?php echo $telephone; ?>">
                    <img class="action" src="../icons/right.svg">
                  </a>
                </div>
              <?php
              }
              ?>
              
              <?php
              if (!empty($whatsapp)) {
              ?>
                <div class="attribute">
                  <img class="icon" src="../icons/Whatsapp.svg">
                  <a class="value" href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>"><?php echo $whatsapp; ?></a><span style="font-weight:500">&nbsp(Whatsapp)</span>
                  <a class="action" href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>">
                    <img class="action" src="../icons/right.svg">
                  </a>

                </div>

              <?php
              }
              ?>

              <?php
              if (!empty($address)) {
              ?>
                <div class="attribute">
                    <img class="icon" src="../icons/Location.svg">
                  <a class="value" href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo $address; ?>">
                    <?php echo $address; ?>
                  </a>
                  <a class="action" href="https://www.google.com/maps/search/?api=1&amp;query=<?php echo $address; ?>">
                    <img class="action" src="../icons/right.svg">
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