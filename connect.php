<?php
require_once 'db_connect.php';

$username = $_GET['username'];
$image_sql = "Select * from users Where username ='$username'";
$image_result = $conn->query($image_sql);

// Execute the query
if ($image_result) {
    //header("Location: http://introcardbd.test/profile/$username");
    //echo $image_sql;
    $row = $image_result->fetch_assoc();
    $users_image_name = $row['image_name'];
    $users_email = $row['email'];
    
    //print_r($users_image_name);
} else {
    echo "Error: " . $image_sql . "<br>" . mysqli_error($conn);
}

function addBackslash($sentence) {
    $sentence = str_replace(array("'", '"', '\\'), array("\'", '\"', "\\\\"), $sentence);
    return $sentence;
}

function sanitizeSentence_one($sentence) {
    $specialCharacters = array("'", '"', '\\');
    $replacementCharacters = array("\'", '\"', '\\');
    
    $sanitizedSentence = str_replace($specialCharacters, $replacementCharacters, $sentence);
    return $sanitizedSentence;
}

function sanitizeSentence_two($sentence) {
    $specialCharacters = array("'", '"', '\\');
    $sanitizedSentence = '';
    
    for ($i = 0; $i < strlen($sentence); $i++) {
        $char = $sentence[$i];
        
        if (in_array($char, $specialCharacters)) {
            $sanitizedSentence .= '\\';
        }
        
        $sanitizedSentence .= $char;
    }
    
    return $sanitizedSentence;
}

// $inputSentence = 'I"m too\'s ba\d.';
// $sanitizedSentence = addBackslash($inputSentence);
// echo $sanitizedSentence;

if (isset($_POST['submit'])) {

    // Get form data
    $name = sanitizeSentence_two($_POST['name']);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $social_link = $_POST['social_link'];
    $message = $_POST['message'];
    $sanitizedmessage = sanitizeSentence_two($message);
    // print_r($sanitizedmessage);
    // die;
    
    // Send the password reset email
    $to = $users_email;
    $subject = "Your Connect Request From TechVibes";
    $message = "Please click the following link to phone $phone  your $message  $email";
    $headers = "From: connect.support@techvibesbd.com";

    if (mail($to, $subject, $message, $headers)) {
      // Email sent successfully
      echo "Password reset link sent to your email address.";
    } else {
      // Error sending email
      echo "Error sending password reset email.";
    }
    
    

    /* echo $phone;
    die; */

    // SQL query to insert data into the connects table
    $sql = "INSERT INTO connects (name, email, phone, social_link, message, username) VALUES ('$name', '$email', '$phone', '$social_link', '$sanitizedmessage', '$username')";

    // Execute the query
    if ($conn->query($sql)) {
        header("Location: ../profile/$username");
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="0VfOKX010PC2fdlLu10P7zViGPZxyTRvtnsgz7Kw">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/events.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    <script src="js/crop.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@700&display=swap" rel="stylesheet">
    <link href="../css/app.css" rel="stylesheet">
    <!-- <link href="css/app.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <link href="../css/link.css" rel="stylesheet">
    <link href="../css/avatar.css" rel="stylesheet">
    <link href="../css/edit.css" rel="stylesheet">
    <title>Tech Vibes</title>
</head>

<body>
    <div id="wrap">
        <div id="app">
            <div id="top">
                <div class="title">Connect Request</div>
                <img class="close" src="../icons/close.svg" onclick="window.location.href='../profile/<?php echo $username; ?>'" />
            </div>

            <div id="form">
                <form method="POST" action="<?php $_PHP_SELF ?>">
                    <div id="avatar-section-upload">
                        <div class="card-preview">
                            <div id="avatar-wrap">
                                <img id="avatar-img" class="" src="../profile/images/<?php echo $users_image_name; ?>" />
                            </div>
                        </div>


                    </div>

                    <div class="subtitle">Fill the Details Please</div>
                    <div>
                        <div class="input-top">
                            <div class="input-tag">Full Name</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="name" type="text" name="name" placeholder="Your Full name" value="" autocomplete="off" class="" maxlength="100" required>
                        </div>
                    </div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">Email address</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="email" type="email" name="email" placeholder="example@gmail.com" value="" autocomplete="off" class="" maxlength="100" required>
                        </div>
                    </div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">Phone personal</div>
                            <div class="input-note">i.e. +8801234567890</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="phone" type="text" name="phone" placeholder="With country code" value="" autocomplete="off" class="" maxlength="100" required>
                        </div>
                    </div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">One Social Link</div>
                            <div class="input-note">I will find you</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="social_link" type="text" name="social_link" placeholder="Full URL" value="" autocomplete="off" class="" maxlength="100">
                        </div>
                    </div>
                    <div>
                        <div class="input-top">
                            <div class="input-tag">Put Your Message</div>
                            <div class="input-counter">0/250</div>
                        </div>

                        <div class="input-box multiline   tagged  ">
                            <textarea id="message" name="message" placeholder="Write your message in 250 letters." autocomplete="off" class=" counter " maxlength="250" required></textarea>
                        </div>
                    </div>
                    <div class="separator-16"></div>

                    <div id="actions">
                        <button class="button bordered highlight first" name="submit" type="submit" value="submit">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>