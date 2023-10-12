<?php
session_start();
print_r($_SESSION);
die;
$_SESSION['username'];
$_SESSION['loggedin'];
echo $_SESSION['user_id'];
die;
if ($_SESSION['loggedin'] !== 1) {
    header("Location: login.php");
    exit;
}

require_once('config.php');

if (isset($_POST['update'])) {
    $user_id = $_SESSION['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $designation = $_POST['designation'];
    $company = $_POST['company'];
    $biography = $_POST['biography'];

    // Update the user's information in the database
    $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', designation = '$designation', company = '$company', biography = '$biography' WHERE id = $user_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "User information updated successfully.";
    } else {
        $error = "Error updating user information: " . mysqli_error($conn);
    }
}

// Fetch the user's information from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User Information</title>
</head>
<body>
    <h1>Edit User Information</h1>

    <?php if (isset($message)) { ?>
        <p style="color: green;"><?php echo $message; ?></p>
    <?php } ?>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <form method="post" action="edit.php">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"><br>

        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"><br>

        <label for="designation">Designation:</label>
        <input type="text" name="designation" value="<?php echo $user['designation']; ?>"><br>

        <label for="company">Company:</label>
        <input type="text" name="company" value="<?php echo $user['company']; ?>"><br>

        <label for="biography">Biography:</label><br>
        <textarea name="biography"><?php echo $user['biography']; ?></textarea><br>

        <input type="submit" name="update" value="Update">
    </form>
</body>
</html>
