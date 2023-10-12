<?php

session_start();

/* if (!isset($_SESSION['username'])) {
  header("Location: http://introcardbd.test/login");
  exit();
} */

// Connect to the database
$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "introcard";

$conn = new mysqli($servername, $dbusername, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Set directory to save uploaded image
$target_dir = "uploads/";

// Get the name of the uploaded image file
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

// Check if image file is a valid image type
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    exit;
}

// Upload the image file to the specified directory
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    exit;
}


// Prepare SQL statement to insert image file name into database
$sql = "INSERT INTO images (username, filename) VALUES ('johndoe', '".basename($_FILES["fileToUpload"]["name"])."')";

// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Crop Image Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
</head>
<body>
<div class="container">
    <h2>Crop Image Example</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Select an image to crop:</label>
                <input type="file" id="image" name="image" accept="image/*">
            </div>
        </div>
        <div class="col-md-6">
            <label>Preview:</label>
            <div id="preview"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="image_cropper"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" id="crop">Crop Image</button>
            <button class="btn btn-success" id="save">Save Image</button>
        </div>
    </div>
</div>
<script>
    // Preview the selected image
const previewImage = () => {
  const preview = document.getElementById("preview");
  const image = document.getElementById("image").files[0];

  if (image) {
    const reader = new FileReader();

    reader.onload = () => {
      const img = document.createElement("img");
      img.src = reader.result;
      img.style.maxWidth = "100%";
      img.style.maxHeight = "100%";
      img.style.objectFit = "contain";
      preview.innerHTML = "";
      preview.appendChild(img);
    };

    reader.readAsDataURL(image);
  } else {
    preview.innerHTML = "";
  }
};

document.getElementById("image").addEventListener("change", previewImage);

// Crop the image
const cropImage = () => {
  const preview = document.getElementById("preview");
  const image = preview.querySelector("img");
  const cropper = new Cropper(image, {
    aspectRatio: 4 / 6,
    crop(event) {},
  });
};

document.getElementById("crop").addEventListener("click", cropImage);

// Save the cropped image
const saveImage = () => {
  const preview = document.getElementById("preview");
  const image = preview.querySelector("img");
  const cropper = new Cropper(image, {
    aspectRatio: 4 / 6,
    cropBoxResizable: false,
    crop(event) {},
  });

  const canvas = cropper.getCroppedCanvas();
  const dataURL = canvas.toDataURL();

  $.ajax({
    type: "POST",
    url: "save_image.php",
    data: {image: dataURL},
    success: function(response) {
      console.log(response);
      // Refresh the page to see the updated image
      location.reload();
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
};

document.getElementById("save").addEventListener("click", saveImage);

</script>
</body>
</html>