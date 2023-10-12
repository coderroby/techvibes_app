<?php
session_start();
$main_user = $_SESSION['username'];
$username = $_GET['username'];

// echo $main_user;
// echo $username;
// die;

if ($_SESSION['loggedin'] !== TRUE) {
    header("Location: ../../login.php");
    exit;
}

require_once 'db_connect.php';

if ($username !== $_SESSION['username']) {
    echo 'This is not your connect list. Redirecting to your profile.';
    header("refresh:3;url=/profile/$main_user");
    exit;
}

$image_sql = "Select * from users Where username ='$username'";
$image_result = $conn->query($image_sql);

// Execute the query
if ($image_result) {
    $row = $image_result->fetch_assoc();
    $users_image_name = $row['image_name'];
} else {
    echo "Error: " . $image_sql . "<br>" . mysqli_error($conn);
}

$theme = $row['theme'];
if ($theme == 'Dark') {
    $theme_css_link = 'app.css';

} else {
    $theme_css_link = 'app_light.css';
}
// SQL query to retrieve data
$sql = "SELECT * FROM connects WHERE username = '$username' ORDER BY id DESC";

// Execute the query
$result = $conn->query($sql);

//total result count
$count = $result->num_rows;
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/events.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js" integrity="sha256-CgvH7sz3tHhkiVKh05kSUgG97YtzYNnWt6OXcmYzqHY=" crossorigin="anonymous"></script>
    <script src="js/crop.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@700&display=swap" rel="stylesheet">
    <link href="../css/<?php echo $theme_css_link ?>" rel="stylesheet">
    <!-- <link href="css/app.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css" integrity="sha256-jKV9n9bkk/CTP8zbtEtnKaKf+ehRovOYeKoyfthwbC8=" crossorigin="anonymous" />
    <link href="../css/link.css" rel="stylesheet">
    <link href="../css/avatar.css" rel="stylesheet">
    <link href="../css/edit.css" rel="stylesheet">
    <title>Tech Vibes</title>
    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn {
            /* border: 2px solid #007bff; */
            color: #007bff;
            background-color: #fff;
            padding: 8px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }

        .radio-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            align-items: center;
        }

        .radio-group input[type="radio"] {
            display: none;
        }

        .radio-group label {
            display: inline-block;
            /* height: 100px; */
            width: 145px;
            border: 2px solid black;
            text-align: center;
            font-size: 1.5rem;
            line-height: 40px;
            cursor: pointer;

        }

        .radio-group label:hover {
            background-color: #ddd;
        }

        .radio-group input[type="radio"]:checked+label {
            background-color: #555;
            color: white;
        }

        .connect-box {
            display: flex;
            flex-direction: column;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .more-info {
            display: none;
        }

        .more-info-btn {
            background-color: #ccc;
            border: none;
            padding: 5px;
            margin-top: 5px;
        }

        .more-info-btn:hover {
            cursor: pointer;
            background-color: #aaa;
        }

        .connect-box.expanded .more-info {
            display: block;
        }
    </style>
</head>



<body>
    <div id="wrap">
        <div id="app">
            <div id="top">
                <div class="title">Your Connects List
                </div>
                <img class="close" src="../icons/close.svg" onclick="window.location.href='../profile/<?php echo $_SESSION['username']; ?>'" />
            </div>

            <div id="form">
                <div id="avatar-section-upload">
                    <div class="card-preview">
                        <div id="avatar-wrap">
                            <img id="avatar-img" class="" src="../profile/images/<?php echo $users_image_name; ?>" />
                        </div>
                    </div>


                </div>
                <div class="actions">
                    <div style="text-align: center;" id="connect-profile-button" class="button bordered highlight">Total Connect Requests: <?php echo $count; ?></div>
                    <br>
                </div>
                <script>
                    $(document).ready(function() {
                        $('.more-info-btn').click(function() {
                            $(this).parent('.connect-box').toggleClass('expanded');
                            if ($(this).parent('.connect-box').hasClass('expanded')) {
                                $(this).text('Less Info');
                            } else {
                                $(this).text('More Info');
                            }
                        });
                    });
                </script>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <div class="connects-container">
                        <!-- Repeat this section for each Connect row -->
                        <div class="connect-box">
                            <div class="name">Name: <?php echo $row['name']; ?></div>
                            <div class="phone">Phone: <?php echo $row['phone']; ?></div>
                            <div class="email">Email: <?php echo $row['email']; ?></div>
                            <div class="more-info">
                                <div class="social-link">Social Link: <?php echo $row['social_link']; ?></div>
                                <div class="message">Message: <?php echo $row['message']; ?></div>
                            </div>
                            <button class="more-info-btn">More Info</button>
                          
                            <button onclick="window.location.href='../save_connect.php?name=<?php echo $row['name']; ?>&phone=<?php echo $row['phone']; ?>&email=<?php echo $row['email']; ?>&social=<?php echo $row['social_link']; ?>'" style="background: #1c252f; color: white; border: 1px solid white; padding: 5px; margin-top: 8px;" class="">Save This Connect</button>

                        </div>
                        <!-- End of Connect row section -->
                    </div>
                <?php
                    $count++;
                }
                //echo $count;
                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</body>

</html>