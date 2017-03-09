<?php
error_reporting(0);
session_start();
if($_SESSION['logged_in'] != TRUE) {
	header('Location: /');
}
if(isset($_POST['logout'])) {
  session_destroy();
  header('Location: /');
  exit();
}
if(isset($_POST['preferences'])) {
	header('Location: /account.php');
	exit();
}
include($_SERVER['DOCUMENT_ROOT'].'/access/sql.php');
$sql = 'SELECT username, linkstyle, tilestyle, postsshown FROM login';
mysqli_select_db($link,'login');
$get = mysqli_query($link, $sql);
$x = -1;
while($row = mysqli_fetch_array($get, MYSQLI_ASSOC)) {
  $x += 1;
  $data[$x] = $row;
}
mysqli_close($link);
$counter = count($data);
for($y = 1; $y < $counter; $y++) {
	if($_SESSION['username'] == $data[$y]['username']) {
		$_SESSION['linkstyle'] = $data[$y]['linkstyle'];
		$_SESSION['tilestyle'] = $data[$y]['tilestyle'];
		$_SESSION['postsshown'] = $data[$y]['postsshown'];
	}
}
echo('<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/webassets/style.css" type="text/css">');
		if ($_SESSION['linkstyle'] == 0) {
			echo("\n".'<link rel="stylesheet" href="/webassets/chan.css" type="text/css">');
		} elseif ($_SESSION['linkstyle'] == 1) {
			echo("\n".'<link rel="stylesheet" href="/webassets/tube.css" type="text/css">');
		}
		echo('
<style>
	body {
		background: #2E3136;
	}
</style>
</head>
<body>
<p class="beta">DEV 0.6</p>
<p class="user">Logged in as '.$_SESSION['username'].'.</p>
<form method="POST" style="position:fixed;right:10px;top:40px;"><input type="submit" name="preferences" value="Preferences"></form>
<form method="POST" style="position:fixed;right:10px;top:68px;"><input type="submit" name="logout" value="Log Out"></form>
')
?>
