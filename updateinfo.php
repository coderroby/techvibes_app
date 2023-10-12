<?php
session_start();
// Get the username from the URL parameter
$username = $_GET['username'];
$main_user = $_SESSION['username'];

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

//print_r($_SESSION);
if (!empty($_SESSION)) {
    $username = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
    $log_status = $_SESSION['loggedin'];
    //echo $user_role;
    //echo $log_status;
    //print_r($_SESSION);
    //die;
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
    $whatsapp = $row['whatsapp'];
    $telephone = $row['telephone'];
    $address = $row['address'];
    //$links = $row['links'];
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
    $wechat = $row['Wechat'];

} else {
    // If the user was not found, display an error message
    echo "User not found";
    exit();
}

if ($theme == 'Dark') {
    $theme_css_link = 'app.css';
    //echo $theme;
} else {
    $theme_css_link = 'app_light.css';
    //echo $theme;
}
//for cheking http or https
function normalizeUrl($url) {
    $url = trim($url); // Remove leading/trailing whitespace

    if (empty($url)) {
        return '';// Return blank if the URL is empty or contains only whitespace
    }

    if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
        $url = "https://" . $url; // Add 'https://' if the URL doesn't start with 'http://' or 'https://'
    }
    
    return $url;
}



// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the updated information from the form
    $updated_first_name = sanitizeSentence_two($_POST['first_name']);
    $updated_last_name = sanitizeSentence_two($_POST['last_name']);
    $updated_email = $_POST['email'];
    $updated_phone = $_POST['phone'];
    $updated_whatsapp = $_POST['whatsapp'];
    $updated_telephone = $_POST['telephone'];
    $updated_address = sanitizeSentence_two($_POST['address']);
    //$updated_links = $_POST['links'];
    $updated_designation = sanitizeSentence_two($_POST['designation']);
    $updated_company = sanitizeSentence_two($_POST['company']);
    $updated_biography = sanitizeSentence_two($_POST['biography']);
    $updated_image_name = $_FILES['image']['name'];
    
    
    if(empty($_POST['theme'])){
        $updated_theme = 'light';
    }
    else $updated_theme = $_POST['theme'];

    // Updated social links retrieve
    $updated_facebook = normalizeUrl($_POST['Facebook']);
    $updated_facebook_page = normalizeUrl($_POST['Facebook_page']);
    $updated_instagram = normalizeUrl($_POST['Instagram']);
    $updated_linkedin = normalizeUrl($_POST['LinkedIn']);
    $updated_youtube = normalizeUrl($_POST['YouTube']);
    $updated_website = normalizeUrl($_POST['Website']);
    $updated_pinterest = normalizeUrl($_POST['Pinterest']);
    $updated_twitter = normalizeUrl($_POST['Twitter']);
    $updated_snapchat = normalizeUrl($_POST['Snapchat']);
    $updated_teams = normalizeUrl($_POST['Teams']);
    $updated_quora = normalizeUrl($_POST['Quora']);
    $updated_tiktok = normalizeUrl($_POST['Tiktok']);
    $updated_twitch = normalizeUrl($_POST['Twitch']);
    $updated_soundcloud = normalizeUrl($_POST['Soundcloud']);
    $updated_vimeo = normalizeUrl($_POST['Vimeo']);
    $updated_spotify = normalizeUrl($_POST['Spotify']);
    $updated_discord = normalizeUrl($_POST['Discord']);
    $updated_behance = normalizeUrl($_POST['Behance']);
    $updated_fiverr = normalizeUrl($_POST['Fiverr']);
    $updated_dribbble = normalizeUrl($_POST['Dribbble']);
    $updated_upwork = normalizeUrl($_POST['Upwork']);
    $updated_wechat = normalizeUrl($_POST['Wechat']);

    // Update the user's information in the database
    $sql = "UPDATE users SET first_name='$updated_first_name', last_name='$updated_last_name', email='$updated_email', phone='$updated_phone', whatsapp='$updated_whatsapp', telephone='$updated_telephone', address='$updated_address', designation='$updated_designation', company='$updated_company', biography='$updated_biography', theme='$updated_theme', ";
    if (!empty($updated_image_name)) {
        $sql .= " image_name='$updated_image_name', ";
        $target_dir = "profile/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $updated_image_name = $_FILES["image"]["name"];

        // Delete the current image from the directory
        $current_image = $image_name;
        if ($updated_image_name !== $current_image) {
            unlink("profile/images/$current_image");
        }
    }
    $sql .= "Facebook= '$updated_facebook', Facebook_page = '$updated_facebook_page', Instagram = '$updated_instagram', LinkedIn = '$updated_linkedin', YouTube = '$updated_youtube', Website = '$updated_website', Pinterest = '$updated_pinterest', Twitter = '$updated_twitter', Snapchat = '$updated_snapchat', Teams = '$updated_teams', Quora = '$updated_quora', Tiktok = '$updated_tiktok', Twitch = '$updated_twitch', Soundcloud = '$updated_soundcloud', Vimeo = '$updated_vimeo', Spotify = '$updated_spotify', Discord = '$updated_discord', Behance = '$updated_behance', Fiverr = '$updated_fiverr', Dribbble = '$updated_dribbble', Upwork='$updated_upwork', Wechat='$updated_wechat'";
    $sql .= " WHERE username='$this_user'";

    if ($conn->query($sql) === TRUE) {
        // If the update was successful, redirect back to the user's profile page
        header("Location: ../profile/$this_user");
        exit();
    } else {
        // If there was an error, display an error message
        echo "Error updating record: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
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
    </style>
</head>



<body>
    <div id="wrap">
        <div id="app">
            <div id="top">
                <div class="title">Edit your profile</div>
                <img class="close" src="../icons/close.svg" onclick="window.location.href='../profile/<?php echo $this_user; ?>'" />
            </div>

            <div id="form">
                <form method="POST" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data" novalidate>
                    <div id="avatar-section-upload">
                        <div class="card-preview">
                            <div id="avatar-wrap">
                                <img id="avatar-img" class="" src="../profile/images/<?php echo $image_name; ?>" />
                            </div>

                            <script>
                                function previewImage() {
                                    var fileInput = document.getElementById('image');
                                    var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
                                    var avatarImg = document.getElementById('avatar-img');
                                    avatarImg.src = fileUrl;
                                }
                            </script>
                        </div>
                        <div style="margin: 0 0 0 25%;" id="avatar-change-button" class="upload-btn-wrapper">
                            <button class="btn button bordered highlight">Change Image</button>
                            <input type="file" name="image" id="image" onchange="previewImage()">
                        </div>

                    </div>

                    <div class="subtitle">Personal</div>

                    <div style="display: grid;grid-auto-flow: column">

                        <div>
                            <div class="input-top">
                                <div class="input-tag">First name</div>
                            </div>

                            <div style="width:120px;margin-right:16px" class="input-box   tagged   ">
                                <input id="first_name" type="text" name="first_name" placeholder="" value="<?php echo $first_name; ?>" autocomplete="off" class="" maxlength="100" autofocus required>
                            </div>

                        </div>

                        <div>
                            <div class="input-top">
                                <div class="input-tag">Last name</div>
                            </div>

                            <div class="input-box   tagged   ">
                                <input id="last_name" type="text" name="last_name" placeholder="" value="<?php echo $last_name; ?>" autocomplete="off" class="" maxlength="100" required>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">Designation</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="designation" type="text" name="designation" placeholder="" value="<?php echo $designation; ?>" autocomplete="off" class="" maxlength="100" required>
                        </div>
                    </div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">Company</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="company" type="text" name="company" placeholder="" value="<?php echo $company; ?>" autocomplete="off" class="" maxlength="100" required>
                        </div>
                    </div>

                    <div id="address">
                        <div id="address">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Address</div>
                                </div>

                                <div class="input-box   tagged  ">
                                    <!-- <textarea name="address" id="address"><?php echo $address; ?></textarea> -->
                                    <input id="address" type="text" name="address" placeholder="" value="<?php echo $address; ?>" autocomplete="off" class="" required>
                                    <!-- <img class="icon " src="icons/down.svg"> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">Biography</div>
                            <div class="input-counter">0/250</div>
                        </div>

                        <div class="input-box multiline   tagged  ">
                            <textarea id="biography" name="biography" placeholder="" autocomplete="off" class=" counter " maxlength="250" required><?php echo $biography; ?></textarea>
                        </div>
                    </div>

                    <div class="separator-32"></div>
                    <div class="subtitle">Login information</div>
                    <div>
                        <div class="input-top">
                            <div class="input-tag">Email address</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="email" type="email" name="email" placeholder="" value="<?php echo $email; ?>" autocomplete="off" class="" maxlength="100" required>
                        </div>
                    </div>

                    <div class="separator-32"></div>
                    <div class="subtitle">Contact <span class="input-tag">(Just input or erase links to update links)</span></div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">Phone personal</div>
                            <div class="input-note">i.e. +8801234567890</div>
                        </div>

                        <div class="input-box   tagged   ">
                            <input id="phone" type="text" name="phone" placeholder="With country code" value="<?php echo $phone; ?>" autocomplete="off" class="" maxlength="100" required>
                        </div>
                    </div>

                    <div>
                        <div class="input-top">
                            <div class="input-tag">Telephone work</div>
                            <div class="input-note">i.e. +8801234567890</div>
                        </div>

                        <div class="input-box   tagged   ">

                            <input id="telephone" type="text" name="telephone" placeholder="With country code" value="<?php echo $telephone; ?>" autocomplete="off" class="" maxlength="100">
                        </div>
                    </div>
                    
                    <div>
                        <div class="input-top">
                            <div class="input-tag">Whatsapp</div>
                            <div class="input-note">i.e. +8801234567890</div>
                        </div>

                        <div class="input-box   tagged   ">

                            <input id="whatsapp" type="text" name="whatsapp" placeholder="With country code" value="<?php echo $whatsapp; ?>" autocomplete="off" class="" maxlength="100">
                        </div>
                    </div>

                    <div id="links">
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Facebook</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Facebook" type="text" name="Facebook" placeholder="Paste entire URL" value="<?php echo $facebook; ?>" autocomplete="off" class="" maxlength="255" required>
                                </div>

                            </div>
                        </div>
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Website</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Website" type="text" name="Website" placeholder="Paste entire URL" value="<?php echo $website; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Facebook_page</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Facebook_page" type="text" name="Facebook_page" placeholder="Paste entire URL" value="<?php echo $facebook_page; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Instagram</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Instagram" type="text" name="Instagram" placeholder="Paste entire URL" value="<?php echo $instagram; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">LinkedIn</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="LinkedIn" type="text" name="LinkedIn" placeholder="Paste entire URL" value="<?php echo $linkedin; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">YouTube</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="YouTube" type="text" name="YouTube" placeholder="Paste entire URL" value="<?php echo $youtube; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Pinterest</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Pinterest" type="text" name="Pinterest" placeholder="Paste entire URL" value="<?php echo $pinterest; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Twitter</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Twitter" type="text" name="Twitter" placeholder="Paste entire URL" value="<?php echo $twitter; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Snapchat</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Snapchat" type="text" name="Snapchat" placeholder="Paste entire URL" value="<?php echo $snapchat; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Teams</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Teams" type="text" name="Teams" placeholder="Paste entire URL" value="<?php echo $teams; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Quora</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Quora" type="text" name="Quora" placeholder="Paste entire URL" value="<?php echo $quora; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Tiktok</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Tiktok" type="text" name="Tiktok" placeholder="Paste entire URL" value="<?php echo $tiktok; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Twitch</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Twitch" type="text" name="Twitch" placeholder="Paste entire URL" value="<?php echo $twitch; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Soundcloud</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Soundcloud" type="text" name="Soundcloud" placeholder="Paste entire URL" value="<?php echo $soundcloud; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Vimeo</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Vimeo" type="text" name="Vimeo" placeholder="Paste entire URL" value="<?php echo $vimeo; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>
                        
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Spotify</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Spotify" type="text" name="Spotify" placeholder="Paste entire URL" value="<?php echo $spotify; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Discord</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Discord" type="text" name="Discord" placeholder="Paste entire URL" value="<?php echo $discord; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Behance</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Behance" type="text" name="Behance" placeholder="Paste entire URL" value="<?php echo $behance; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Fiverr</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Fiverr" type="text" name="Fiverr" placeholder="Paste entire URL" value="<?php echo $fiverr; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Dribbble</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Dribbble" type="text" name="Dribbble" placeholder="Paste entire URL" value="<?php echo $dribbble; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Upwork</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Upwork" type="text" name="Upwork" placeholder="Paste entire URL" value="<?php echo $upwork; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>
                        <div class="link" id=" ">
                            <div>
                                <div class="input-top">
                                    <div class="input-tag">Wechat</div>
                                </div>
                                <div style="margin-bottom:0" class="input-box   tagged   ">
                                    <input id="Wechat" type="text" name="Wechat" placeholder="Paste entire URL" value="<?php echo $wechat; ?>" autocomplete="off" class="" maxlength="255">
                                </div>

                            </div>
                        </div>

                        <div class="separator-48"></div>

                        <div class="title-wrap">

                            <div class="title">Color scheme</div>

                            <div class="note">Tap to change</div>

                        </div>

                        <div class="themes">
                            <div class="radio-group">
                                <input type="radio" name="theme" id="dark" value="Dark">
                                <label style="background: #172548; color: white" for="dark">Dark theme</label>
                                <input type="radio" name="theme" id="light" value="light">
                                <label style="background:rgb(21,155,214);color: black" for="light">Light theme</label>
                            </div>
                        </div>
                        <script>
                            const app = document.getElementById('app');
                            const darkRadio = document.getElementById('dark');
                            const lightRadio = document.getElementById('light');

                            darkRadio.addEventListener('change', () => {
                                if (darkRadio.checked) {
                                    app.style.backgroundColor = '#172548';
                                    document.querySelectorAll('.input-tag').forEach(input => {
                                        input.style.color = '#fff';
                                    });
                                    document.querySelectorAll('.note').forEach(input => {
                                        input.style.color = '#fff';
                                    });
                                    document.querySelectorAll('.input-note').forEach(input => {
                                        input.style.color = 'rgb(213 207 207)';
                                    });
                                    
                                    document.querySelectorAll('.subtitle').forEach(input => {
                                        input.style.color = '#fff';
                                    });
                                    document.querySelectorAll('.title').forEach(input => {
                                        input.style.color = '#fff';
                                    });
                                    document.querySelectorAll('.close').forEach(input => {
                                        input.style.backgroundColor = 'transparent';
                                    });

                                }
                            });

                            lightRadio.addEventListener('change', () => {
                                if (lightRadio.checked) {
                                    app.style.backgroundColor = 'rgb(21,155,214)';
                                    document.querySelectorAll('.input-tag').forEach(input => {
                                        //input.style.color = '#000000';
                                        input.style.color = '#fff';
                                    });
                                    document.querySelectorAll('.subtitle').forEach(input => {
                                        //input.style.color = '#000000';
                                        input.style.color = '#fff';

                                    });
                                     document.querySelectorAll('.note').forEach(input => {
                                        input.style.color = '#fff';
                                    });
                                    document.querySelectorAll('.input-note').forEach(input => {
                                        input.style.color = 'rgb(213 207 207)';
                                    });
                                    document.querySelectorAll('.title').forEach(input => {
                                        //input.style.color = '#000000';
                                        input.style.color = '#fff';
                                    });
                                    document.querySelectorAll('.close').forEach(input => {
                                        input.style.backgroundColor = '#000000';
                                    });

                                }
                            });
                        </script>

                        <div class="separator-48"></div>

                        <div id="actions">
                            <button class="button bordered highlight first" name="submit" type="submit" value="submit">
                                SAVE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>