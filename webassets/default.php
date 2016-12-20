<?php
error_reporting(error_reporting()&~E_NOTICE);
session_start();
if ($_SESSION["logged_in"] != TRUE) {
	header("Location: /");
}
if (isset($_POST['logout'])) {
    $_SESSION["logged_in"] = 0;
    $_SESSION["username"] = NULL;
    header("Location: /");
    exit();
}
echo
('<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/webassets/font.css" type="text/css">
</head>
<body bgcolor="#1D1F21">
<p class="beta">BETA 0.3</p>
</div>
<form method="POST" style="position:fixed;right:10px;top:40px">
<input type="submit" name="logout" value="Log Out">
</form>
')
?>
