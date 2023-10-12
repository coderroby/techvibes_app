<!doctype html>

<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../../ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/events.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@700&amp;display=swap" rel="stylesheet">
    <link href="../css/app.css" rel="stylesheet">
    <link href="../css/reset.css" rel="stylesheet">

    <title>Tech Vibes</title>

</head>


<body>
    
    
    <div id="wrap">
        <div id="app">
            <div id="top">
                <div class="title">Reset Password</div>
            </div>

            <div id="content">
                <form method="POST" action="">
                    <div>
                        <div class="input-top">
                            <div class="input-tag">Email address</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="email" type="email" name="email" placeholder="Write your mail here.." value="" autocomplete="email" class="" autofocus required>
                        </div>

                    </div>

                    <button type="submit" name="submit"class="button highlight bordered">Send Reset Password Link</button>
                    <br><br>
                </form>
                <?php
                // Assuming you have already established a database connection ($conn)
                require_once 'db_connect.php';
                if (isset($_POST['submit'])) {
                  $email = $_POST['email'];
                
                  // Check if the email exists in the users table
                  $sql = "SELECT * FROM users WHERE email = ?";
                  $stmt = $conn->prepare($sql);
                  $stmt->bind_param("s", $email);
                  $stmt->execute();
                  $result = $stmt->get_result();
                
                  if ($result->num_rows > 0) {
                    // User exists, generate a password reset token and send the email
                    $token = generateResetToken();
                    $resetLink = "https://user.techvibesbd.com/password_reset.php?mail=$email&token=$token";
                    
                    $sql = "UPDATE `users` SET `token` = '$token' WHERE `users`.`email` = '$email'";
                
                    // if ($conn->query($sql) === TRUE) {
                    //     // If the update was successful, redirect back to the user's profile page
                    //     header("Location: ../profile/$this_user");
                    //     exit();
                    // } else {
                    //     // If there was an error, display an error message
                    //     echo "Error updating record: " . $conn->error;
                    // }
                
                    // Send the password reset email
                    $to = $email;
                    $subject = "Password Reset";
                    $message = "Please click the following link to reset your password: $resetLink";
                    $headers = "From: user.support@techvibesbd.com";
                
                    if (mail($to, $subject, $message, $headers) && $conn->query($sql) === TRUE) {
                      // Email sent successfully
                      echo "Password reset link sent to your email address. Please check your email.";
                    } else {
                      // Error sending email
                      echo "Error sending password reset email.";
                    }
                  } else {
                    // User does not exist
                    echo "This user does not exist in our system.";
                  }
                
                  $stmt->close();
                  $conn->close();
                }
                
                function generateResetToken() {
                  // Generate a unique token for password reset
                  // You can use libraries like "random_compat" or "random_bytes" for better token generation
                  $token = bin2hex(random_bytes(32));
                  return $token;
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>