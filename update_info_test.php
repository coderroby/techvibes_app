<?php
session_start();
// Get the username from the URL parameter
$username = $_GET['username'];

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
} else {
    // If the user was not found, display an error message
    echo "User not found";
    exit();
}

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Get the updated information from the form
    $updated_first_name = $_POST['first_name'];
    $updated_last_name = $_POST['last_name'];
    $updated_email = $_POST['email'];
    $updated_phone = $_POST['phone'];
    $updated_telephone = $_POST['telephone'];
    $updated_address = $_POST['address'];
    //$updated_links = $_POST['links'];
    $updated_designation = $_POST['designation'];
    $updated_company = $_POST['company'];
    $updated_biography = $_POST['biography'];
    $updated_image_name = $_FILES['image']['name'];
    $updated_theme = $_POST['theme'];

    // Updated social links retrieve
    $updated_facebook = $_POST['Facebook'];
    $updated_facebook_page = $_POST['Facebook_page'];
    $updated_instagram = $_POST['Instagram'];
    $updated_linkedin = $_POST['LinkedIn'];
    $updated_youtube = $_POST['YouTube'];
    $updated_website = $_POST['Website'];
    $updated_pinterest = $_POST['Pinterest'];
    $updated_twitter = $_POST['Twitter'];
    $updated_snapchat = $_POST['Snapchat'];
    $updated_teams = $_POST['Teams'];
    $updated_quora = $_POST['Quora'];
    $updated_tiktok = $_POST['Tiktok'];
    $updated_twitch = $_POST['Twitch'];
    $updated_soundcloud = $_POST['Soundcloud'];
    $updated_vimeo = $_POST['Vimeo'];
    $updated_spotify = $_POST['Spotify'];
    $updated_discord = $_POST['Discord'];
    $updated_behance = $_POST['Behance'];
    $updated_fiverr = $_POST['Fiverr'];
    $updated_dribbble = $_POST['Dribbble'];
    $updated_upwork = $_POST['Upwork'];




    // Update the user's information in the database
    $sql = "UPDATE users SET first_name='$updated_first_name', last_name='$updated_last_name', email='$updated_email', phone='$updated_phone', telephone='$updated_telephone', address='$updated_address', designation='$updated_designation', company='$updated_company', biography='$updated_biography', theme='$updated_theme', ";
    if (!empty($updated_image_name)) {
        $sql .= " image_name='$updated_image_name', ";
        $target_dir = "profile/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $updated_image_name = $_FILES["image"]["name"];

        // Delete the current image from the directory
        $current_image = $image_name;
        unlink("profile/images/$current_image");
    }
    $sql .= "Facebook= '$updated_facebook', Facebook_page = '$updated_facebook_page', Instagram = '$updated_instagram', LinkedIn = '$updated_linkedin', YouTube = '$updated_youtube', Website = '$updated_website', Pinterest = '$updated_pinterest', Twitter = '$updated_twitter', Snapchat = '$updated_snapchat', Teams = '$updated_teams', Quora = '$updated_quora', Tiktok = '$updated_tiktok', Twitch = '$updated_twitch', Soundcloud = '$updated_soundcloud', Vimeo = '$updated_vimeo', Spotify = '$updated_spotify ', Discord = '$updated_discord', Behance = '$updated_behance', Fiverr = '$updated_fiverr', Dribbble = '$updated_dribbble', Upwork='$updated_upwork'";
    $sql .= " WHERE username='$this_user'";

    /* echo"<pre>";
    print_r($updated_theme );
    echo"<pre>";
    print_r($sql );
    echo"</pre>";
    die; */

    if ($conn->query($sql) === TRUE) {
        // If the update was successful, redirect back to the user's profile page
        header("Location: http://introcardbd.test/profile/$this_user");
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
    <meta name="_token" content="0VfOKX010PC2fdlLu10P7zViGPZxyTRvtnsgz7Kw">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn {
            border: 2px solid #007bff;
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
    </style>
</head>



<body>
    <form method="post" action="" enctype="multipart/form-data">

    </form>



    <form method="POST" action="<?php $_PHP_SELF ?>" enctype="multipart/form-data" novalidate>
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" value="<?php echo $first_name; ?>">
        <br>
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo $last_name; ?>">
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>">
        <br>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" value="<?php echo $phone; ?>">
        <br>
        <label for="telephone">Telephone:</label>
        <input type="text" name="telephone" id="telephone" value="<?php echo $telephone; ?>">
        <br>
        <label for="address">Address:</label>
        <textarea name="address" id="address"><?php echo $address; ?></textarea>
        <br>
        <label for="image">Profile Image:</label>
        <div id="avatar-wrap">
            <img id="avatar-img" class="" src="profile/images/<?php echo $image_name; ?>" />
        </div>
        <div class="upload-btn-wrapper">
            <button class="btn">Change Image</button>
            <input type="file" name="image" id="image" onchange="previewImage()">
        </div>
        <!-- <input type="file" name="image" id="image" onchange="previewImage()"> -->

        <script>
            function previewImage() {
                var fileInput = document.getElementById('image');
                var fileUrl = window.URL.createObjectURL(fileInput.files[0]);
                var avatarImg = document.getElementById('avatar-img');
                avatarImg.src = fileUrl;
            }
        </script>
        <br>
        <label for="links">facebook:</label>
        <input type="text" name="Facebook" id="links" value="<?php echo $facebook; ?>">
        <br>
        <label for="links">facebook_page:</label>
        <input type="text" name="Facebook_page" id="links" value="<?php echo $facebook_page; ?>">
        <br>
        <label for="links">instagram:</label>
        <input type="text" name="Instagram" id="links" value="<?php echo $instagram; ?>">
        <br>
        <label for="links">linkedin:</label>
        <input type="text" name="LinkedIn" id="links" value="<?php echo $linkedin; ?>">
        <br>
        <label for="links">Youtube:</label>
        <input type="text" name="YouTube" id="links" value="<?php echo $youtube; ?>">
        <br>
        <label for="links">Website:</label>
        <input type="text" name="Website" id="links" value="<?php echo $website; ?>">
        <br>
        <label for="links">Pinterest:</label>
        <input type="text" name="Pinterest" id="links" value="<?php echo $pinterest; ?>">
        <br>
        <label for="links">twitter:</label>
        <input type="text" name="Twitter" id="links" value="<?php echo $twitter; ?>">
        <br>
        <label for="links">Snapchat:</label>
        <input type="text" name="Snapchat" id="links" value="<?php echo $snapchat; ?>">
        <br>

        <label for="links">Teams:</label>
        <input type="text" name="Teams" id="links" value="<?php echo $teams; ?>">
        <br>
        <label for="links">Quora:</label>
        <input type="text" name="Quora" id="links" value="<?php echo $quora; ?>">
        <br>
        <label for="links">Tiktok:</label>
        <input type="text" name="Tiktok" id="links" value="<?php echo $tiktok; ?>">
        <br>
        <label for="links">Twitch:</label>
        <input type="text" name="Twitch" id="links" value="<?php echo $twitch; ?>">
        <br>
        <label for="links">Soundcloud:</label>
        <input type="text" name="Soundcloud" id="links" value="<?php echo $soundcloud; ?>">
        <br>
        <label for="links">Vimeo:</label>
        <input type="text" name="Vimeo" id="links" value="<?php echo $vimeo; ?>">
        <br>
        <label for="links">Spotify:</label>
        <input type="text" name="Spotify" id="links" value="<?php echo $spotify; ?>">
        <br>
        <label for="links">Discord:</label>
        <input type="text" name="Discord" id="links" value="<?php echo $discord; ?>">
        <br>
        <label for="links">Behance:</label>
        <input type="text" name="Behance" id="links" value="<?php echo $behance; ?>">
        <br>
        <label for="links">Fiverr:</label>
        <input type="text" name="Fiverr" id="links" value="<?php echo $fiverr; ?>">
        <br>
        <label for="links">Spotify:</label>
        <input type="text" name="Spotify" id="links" value="<?php echo $spotify; ?>">
        <br>
        <label for="links">Dribbble:</label>
        <input type="text" name="Dribbble" id="links" value="<?php echo $dribbble; ?>">
        <br>
        <label for="links">Upwork:</label>
        <input type="text" name="Upwork" id="links" value="<?php echo $upwork; ?>">
        <br>
        <label for="designation">Designation:</label>
        <input type="text" name="designation" id="designation" value="<?php echo $designation; ?>">
        <br>
        <label for="company">Company:</label>
        <input type="text" name="company" id="company" value="<?php echo $company; ?>">
        <br>
        <label for="biography">Biography:</label>
        <textarea name="biography" id="biography"><?php echo $biography; ?></textarea>
        <br>
        <label for="theme">Theme:</label>
        <select name="theme" id="theme">
            <option value="dark" <?php if ($theme == 'dark') echo 'selected'; ?>>Dark</option>
            <option value="light" <?php if ($theme == 'light') echo 'selected'; ?>>Light</option>
        </select>
        <br>
        <input type="hidden" name="username" value="<?php echo $this_user; ?>">
        <!-- <input type="submit" name="submit" value="Save"> -->

        <div id="actions">
            <button class="button bordered highlight first" name="submit" type="submit">
                SAVE
            </button>
        </div>
    </form>
    </div>
    </div>
    </div>
</body>

</html>