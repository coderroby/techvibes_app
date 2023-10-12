<?php
if(isset($_POST['submit'])) {
  $selected_theme = $_POST['theme'];
  // Do something with the selected theme value, such as saving it to a database or using it to change the website theme
    echo "theme name". $selected_theme;

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


<form method="post">
  <div class="radio-group">
    <input type="radio" name="theme" id="dark" value="Dark">
    <label style="background: #121212; color: white" for="dark">Dark theme</label>
    <input type="radio" name="theme" id="light" value="light">
    <label style="background:lightblue;color: black" for="light">Light theme</label>
  </div>
  <input type="submit" name="submit" value="Submit">
</form>

</body>
</html>