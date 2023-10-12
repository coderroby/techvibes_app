<?php
//require_once('profile.php');
session_start();
$username = $_SESSION['username'];
session_unset();
session_destroy();
header('Location: profile/'.$username);
//header('Location: login.php');
exit;
?>