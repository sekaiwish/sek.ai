<?php
error_reporting(error_reporting()&~E_NOTICE);
session_start();
if($_SESSION["logged_in"] != TRUE) {
	header("Location: /");
}
if(isset($_POST['logout'])) {
  session_destroy();
  header("Location: /");
  exit();
}
if(isset($_POST['preferences'])) {
	header("Location: /access/preferences.php");
	exit();
}
$link = mysqli_connect("127.0.0.1","root","nig");
$sql = 'SELECT username, linkstyle, tilestyle FROM login';
mysqli_select_db($link, 'login');
$get = mysqli_query($link, $sql);
$x = -1;
while($row = mysqli_fetch_array($get, MYSQLI_ASSOC)) {
  $x += 1;
  $data[$x] = $row;
}
mysqli_close($link);
$counter = count($data);

for($y = 1; $y < $counter; $y++) {
	if($_SESSION["username"] == $data[$y]["username"]) {
		$_SESSION["linkstyle"] = $data[$y]["linkstyle"];
		$_SESSION["tilestyle"] = $data[$y]["tilestyle"];
	}
}
echo('<!DOCTYPE html>
<html>
	<head>
		<link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="/webassets/font.css" type="text/css">');
		if ($_SESSION["linkstyle"] == 0) {
			echo("\n".'		<link rel="stylesheet" href="/webassets/chan.css" type="text/css">');
		} elseif ($_SESSION["linkstyle"] == 1) {
			echo("\n".'		<link rel="stylesheet" href="/webassets/tube.css" type="text/css">');
		}
		echo("\n	".'</head>
	<body bgcolor="#1D1F21">
		<p class="beta">
			DEV 0.5
		</p>
		<p style="position:fixed;right:10px;top:0px">
			Logged in as '.$_SESSION["username"].'.
		</p>
		<form method="POST" style="position: fixed; right: 10px; top: 40px;">
			<input type="submit" name="preferences" value="Preferences">
		</form>
		<form method="POST" style="position: fixed; right: 10px; top: 68px;">
			<input type="submit" name="logout" value="Log Out">
		</form>
')
?>
