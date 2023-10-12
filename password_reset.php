<?php
require_once 'db_connect.php';
$email = $_GET['mail'];
$token = $_GET['token'];
// echo $email ."<br>";
// echo $token ."<br>";

// Check if the email exists in the users table
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $token_db = $row['token'];
    $user_email =  $row['email'];
    $user_profile =  $row['email'];
    // echo $token;
}
else {
// User does not exist
echo "This user does not exist in our system.";
}




?>

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
                <div class="title">Reset Password</div> <p> for <b>
                    <?php
                    echo $email;
                    ?>
                </b></p>
            </div>

            <div id="content">
                <?php
                if($token === $token_db){
                ?>
                <form method="POST" action="">
                    <div>
                        <div class="input-top">
                            <div class="input-tag"></div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="new_pass" type="text" name="new_pass" placeholder="Write your new password here" value="" class="" autofocus required>
                        </div>

                    </div>

                    <button type="submit" name="submit"class="button highlight bordered">Reset Password</button>
                    <br><br>
                </form>
                <?php
                }
                else echo "This link is no more valid. Token number is not matching with Database. <br> <br>" . '<a class="button bordered highlight first" href="https://user.techvibesbd.com/login.php">LOGIN FROM HERE</a>
                        <br><br>';
                ?>
                <?php
                    if (isset($_POST['submit'])) {
                    $new_pass = md5($_POST['new_pass']);
                    $sql = "UPDATE `users` SET `password` = '$new_pass' WHERE `users`.`email` = '$user_email'";
                    $token_change = $token ."changed";
                    
                    $token_change_sql = "UPDATE `users` SET `token` = '$token_change' WHERE `users`.`email` = '$user_email'";
                    $conn->query($token_change_sql);
                    
                    if ($conn->query($sql) === TRUE) {
                        // If the update was successful, redirect back to the user's profile pa
                        header("Location: congratulation.html");
                    } else {
                        // If there was an error, display an error message
                        echo "Error updating record: " . $conn->error;
                    }
                  $conn->close();
                  
                }
                ?>
                
            </div>
        </div>
    </div>
</body>

</html>