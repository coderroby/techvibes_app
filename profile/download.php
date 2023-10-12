<?php
session_start();
// Get the username from the URL parameter
// Loop through all session data
/* foreach ($_SESSION as $key => $value) {
  // Do something with the key and value
  echo "Key: " . $key . " Value: " . $value . "<br>";
} */
$username = $_GET['username'];
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
    $address = $row['address'];
    $links = $row['links'];
    $designation = $row['designation'];
    $company = $row['company'];
    $biography = $row['biography'];
    $image_name = $row['image_name'];
    $theme = $row['theme'];

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

    // Set vCard properties
    $vc_name = $first_name . ' ' . $last_name;

    // Create vCard file
    $filename = $vc_name . '.vcf';
    $vcard = "BEGIN:VCARD\n";
    $vcard .= "VERSION:2.1\n";
    $vcard .= "N:$vc_name\n";
    $vcard .= "FN:$vc_name\n";
    $vcard .= "EMAIL:$email\n";
    $vcard .= "TEL;TYPE=HOME,VOICE:$phone\n";
    $vcard .= "TEL;TYPE=WORK,VOICE:$telephone\n";
    $vcard .= "ORG:" . $company . "\r\n";
    $vcard .= "TITLE:" . $designation . "\r\n";
    $vcard .= "ADR;TYPE=WORK:;;" . $address . "\r\n";
    $vcard .= "NOTE:" . $biography . "\r\n";
    $vcard .= "URL;TYPE=" . "Facebook" . ":" . $facebook . "\r\n";
    $vcard .= "URL;TYPE=" . "Website" . ":" . $website . "\r\n";

    // Check if the user has an image and include it in the vCard
    if (!empty($image_name)) {
        $image_path = "images/" . $image_name;
        $image_data = file_get_contents($image_path);
        $image_base64 = base64_encode($image_data);
        $vcard .= "PHOTO;TYPE=JPEG;ENCODING=b:" . $image_base64 . "\r\n";
    }
    $vcard .= "END:VCARD";

    // Set HTTP headers for vCard download
    header('Content-type: text/x-vcard');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    // Output vCard file contents
    echo $vcard;
}
