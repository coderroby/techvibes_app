<?php
session_start();
// Get the username from the URL parameter
//$username = $_GET['username'];
if (!empty($_SESSION)) {
    $username = $_SESSION['username'];
    $user_role = $_SESSION['user_role'];
    $log_status = $_SESSION['loggedin'];
    //echo $user_role;
    //echo $log_status;
    //print_r($_SESSION);
    //die;
} else {
    header("Location: login.php");
}


?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="auwN206kCCjppZG9henGs25ozIAwPyRGCt8hhZFk">
    <script src="ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/events.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Arimo:wght@700&amp;display=swap" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <link href="css/menu.css" rel="stylesheet">

    <title>Tech Vibes</title>
</head>

<body>
    <div id="wrap">
        <div id="app">
            <div id="top">
                <img id="logo" src="images/TechVibes.png">
                <img class="close" src="icons/close.svg" onclick="window.location.href='login.php'" />
            </div>

            <div id="content">
                <a class="button menu" href="updateinfo/<?php echo $username ?>">EDIT PROFILE</a>
                <a class="button menu" href="connect_list/<?php echo $username ?>">Your Connects</a>
                <?php
                if ($user_role == 1) {
                    echo '<a class="button menu" href="registration.php">Add New User</a>';
                }
                ?>
                <a class="button menu" href="mailto:techvibesbd@gmail.com">HELP</a>
                <a class="button menu" href="mailto:techvibesbd@gmail.com">CONTACT US</a>
                <a class="button menu" href="profile/<?php echo $username ?>">Return to Profile View</a>
                <a class="button menu last" onclick="event.preventDefault(); document.getElementById('logout').submit();">LOGOUT</a>
                <form id="logout" action="logout.php" method="POST" style="display: none"><input type="hidden" name="_token" value=""></form>
                <a class="button highlight bordered" href="https://techvibesbd.com">VISIT THE WEBSHOP</a>
            </div>
        </div>
    </div>
</body>

</html>