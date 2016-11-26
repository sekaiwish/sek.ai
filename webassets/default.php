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
<div style="position:fixed;left:18px;bottom:10px;background-color:#777777;width:100px;height:30px;">
<p class="beta">DEV 0.4.3</p>
</div>
<p style="position:fixed;right:10px;top:0px">Logged in as '.$_SESSION["username"].'.</p>
<form method="POST" style="position:fixed;right:10px;top:40px">
<input type="submit" name="logout" value="Log Out">
</form>
')
?>
