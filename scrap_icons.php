<?php
$urls = [
    "https://introcardbd.app/images/link-discord-dark.svg",
];

// Define the custom directory to save the images
$directory = "icons/social/";

// Loop through each URL and download the image
foreach ($urls as $url) {
    // Extract the image file name from the URL
    $file_name = basename($url);

    // Define the file path to save the image
    $file_path = $directory . $file_name;

    // Download the image from the URL and save it to the file path
    file_put_contents($file_path, file_get_contents($url));
}
?>
