<?php
session_start();

session_unset();
session_destroy();
//print_r($_SESSION);
$error = "";

require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the username and password from the login form
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Query the database for the user's password
  $sql = "SELECT * FROM users WHERE email = '$email'";

  $result = $conn->query($sql);
  /* print_r($result) ;
  die; */

  if ($result->num_rows > 0) {
    // If the user was found, check their password
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];
    $user_role = $row['role'];
    // $test1 = md5($password);
    // echo $test1.'<br>';
    // echo $stored_password.'<br><br>';
    // echo $email.'<br>';
    // print-r($_SESSION);
    
    // die;
    if (md5($password) == $stored_password) {
      /* if ($result->num_rows > 0) {
        // If the user was found, display their details in HTML
        $row = $result->fetch_assoc();

        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
      } */
      // If the password is correct, redirect to the edit page
      session_start();
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $username = $row['username'];
      $_SESSION['username'] = $username;
      $_SESSION["loggedin"] = True;
      $_SESSION["user_role"] = $user_role;
      header("Location: profile/$username");
      echo "yeah you are in $username ";

      
      //print_r($result);
    } else {
      // If the password is incorrect, display an error message
      $error = "Incorrect password.";
    }
  } else {
    // If the user was not found, display an error message
    $error = "User not found.";
  }

  $conn->close();
}
?>

<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="_token" content="DlDyItmQdeKL8gtZlMwqYYXJta83xs0qHCO5fVjn">
  <script src="../ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/events.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@700&amp;display=swap" rel="stylesheet">
  <link href="css/app.css" rel="stylesheet">
  <link href="css/login.css" rel="stylesheet">
  <title>Tech Vibes</title>
</head>

<body>
  <div id="wrap">
    <div id="app">
      <div id="top">
        <img id="logo" src="images/logo1.png" />
        <div style="text-align: center; padding-bottom: 50px; margin-top: -80px;">Connect with other people and exchange your details by using <span style="font-family: 'Arimo', serif; font-weight: 700">TechVibes</span></div>
      </div>

      <div id="form">
        <form method="POST" action="" novalidate>

          <!-- <form method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email"><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password"><br>
            <input type="submit" value="Log in">
          </form>
          <p style="color: red;">< ?php echo $error; ?></p> -->

          <div>
            <div class="input-box">
              <input style="color: #F0F0F0;" id="email" type="email" name="email" placeholder="email address" value="" class="" autofocus required>
            </div>
          </div>

          <div>
            <div class="input-box">
              <input style="color: #F0F0F0;"  id="password" type="password" name="password" placeholder="Your Password" value="" class="" required>
              <img class="icon  password-visible-toggle " src="icons/visible-off.svg">
            </div>
            <p style="color: red;"><?php echo $error; ?></p>
          </div>
           <a id="forgot" class="button small" href="reset.php">FORGOT PASSWORD?</a> 
          <div id="actions">
            <a class="button bordered highlight first" href="https://techvibesbd.com/">GET YOUR CARD</a>
            <button class="button bordered" type="submit">LOGIN</button>

          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>