<?php
error_reporting(error_reporting()&~E_NOTICE);
session_start();
if ($_SESSION["logged_in"] != TRUE) {
    include('webassets/logged_out.php');
}
elseif ($_SESSION["logged_in"] = TRUE) {
    include('webassets/logged_in.php');
}
if (isset($_POST['logout'])) {
    $_SESSION["logged_in"] = 0;
    $_SESSION["username"] = NULL;
    header("Location: /");
    exit();
}
?>
