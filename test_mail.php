
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
    $resetLink = "https://example.com/reset-password.php?token=$token";

    // Send the password reset email
    $to = $email;
    $subject = "Password Reset";
    $message = "<div style='background: red;'>Please click the following link to reset your password: $resetLink </div>";
    $headers = "From: user.support@techvibesbd.com";

    if (mail($to, $subject, $message, $headers)) {
      // Email sent successfully
      echo "Password reset link sent to your email address.";
    } else {
      // Error sending email
      echo "Error sending password reset email.";
    }
  } else {
    // User does not exist
    echo "This user does not exist in our system.";
  }

  $stmt->close();
}

function generateResetToken() {
  // Generate a unique token for password reset
  // You can use libraries like "random_compat" or "random_bytes" for better token generation
  $token = bin2hex(random_bytes(32));
  return $token;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- HTML form for requesting password reset -->
    <form action="" method="post">
        <label for="email">Email Address:</label>
        <input type="email" name="email" required>
        <button type="submit" name="submit">Send Reset Link</button>
    </form>

</body>

</html>