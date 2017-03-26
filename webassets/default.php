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
if(isset($_POST['account'])) {
	header('Location: /account/');
	exit();
}
include("{$_SERVER['DOCUMENT_ROOT']}/access/sql.php");
$get = mysqli_query($link, "SELECT linkstyle, tilestyle, postsshown FROM login WHERE username = '{$_SESSION['username']}'");
$data = mysqli_fetch_array($get,MYSQLI_ASSOC);
mysqli_close($link);
$_SESSION['linkstyle'] = $data['linkstyle'];
$_SESSION['tilestyle'] = $data['tilestyle'];
$_SESSION['postsshown'] = $data['postsshown'];
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
<p class="beta"><a class="notHighlight" target="_blank" href="https://github.com/Sek-ai/Sek.ai/tree/dev-0.6">DEV 0.6</a></p>
<p class="user">Logged in as '.$_SESSION['username'].'.</p>
<a href="/account/" style="position:fixed;right:6px;top:35px;"><button>Account</button></a>
<form method="POST" style="position:fixed;right:10px;top:68px;"><input type="submit" name="logout" value="Log Out"></form>
')
?>
