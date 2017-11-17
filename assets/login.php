<?php
# Handle users that are already signed in
session_start();
if($_SESSION["logged_in"] == TRUE && $_SESSION["userid"] != "1") {
	header("Location: /");
	exit();
}
if(isset($_POST["register"])) {
	header("Location: /register/");
	exit();
}
$time = microtime();
$time = explode(" ", $time);
$time = $time[1] + $time[0];
$start = $time;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="robots" content="noindex">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link type="image/png" href="/assets/favicon/256.png" sizes="256x256" rel="icon">
	<link type="image/png" href="/assets/favicon/32.png" sizes="32x32" rel="icon">
	<link type="image/png" href="/assets/favicon/16.png" sizes="16x16" rel="icon">
	<link href="/assets/favicon/180.png" sizes="180x180" rel="apple-touch-icon">
	<link href="/assets/manifest.json" rel="manifest">
	<link href="/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/font-awesome.min.css" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">
	<link href="/css/login.css" rel="stylesheet">
	<title>
		Sekai: Sign in
	</title>
</head>
<body>
	<div class="card">
		<div class="card-header">
			Sign in
		</div>
		<div class="card-block">
			<form onsubmit="return validateLogin(0)" id="login" action="/access/login.php" method="POST">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user-circle fa-fw"></i></span>
					<input class="form-control" type="text" placeholder="ユーザー名" id="username" name="username" maxlength="16" required>
				</div>
				<br>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock fa-fw"></i></span>
					<input class="form-control" type="password" placeholder="パスワード" id="password" name="password" maxlength="16" required>
				</div>
				<br>
				<button class="btn btn-primary" type="submit">
					<i class="fa fa-sign-in"></i> Log in
				</button>
				<a class="btn btn-outline-success" href="/register/">
					<i class="fa fa-pencil-square-o"></i> Register
				</a>
			</form>
		</div>
	</div>
<?php
# Display variable messages by various session updaters
if(isset($_SESSION["loginerror"])) {
  echo("	<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
		<strong>Login Error:</strong> ");
  if($_SESSION["loginerror"] == 1) {
    echo("User not found.");
  } elseif($_SESSION["loginerror"] == 2) {
    echo("Your account has not been approved yet.");
  } elseif($_SESSION["loginerror"] == 3) {
    echo("Incorrect password.");
  } else {
		echo("Login failed.");
	}
  echo("\n  </div>\n");
  unset($_SESSION["loginerror"]);
}
if(isset($_SESSION["activated"])) {
	echo("	<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>
		<strong>Account confirmed.</strong>
	</div>\n");
	unset($_SESSION["activated"]);
}
?>
	<p class="header">
		Sekai
	</p>
<?php
include("{$_SERVER["DOCUMENT_ROOT"]}/access/sql.php");
$ip = $_SERVER["REMOTE_ADDR"];
$getView = mysqli_query($link,"SELECT count FROM views ORDER BY count DESC LIMIT 1");
$getView = mysqli_fetch_array($getView,MYSQLI_ASSOC);
$newView = $getView["count"] + 1;
if($ip != "127.0.0.1") {
  if(mysqli_query($link,"INSERT INTO views (ip) VALUES ('$ip')")) {
    mysqli_close($link);
    echo("	<div class=\"viewcount mobile-hidden\">");
    $newView = str_split($newView);
    $places = count($newView);
    if(end($newView) == prev($newView)) {
      echo("		<p style=\"text-align:center;\">Checked!</p>");
    }
		$x = 0;
    while($x < $places) {
      echo("<img src=\"/assets/views/{$newView[$x]}.gif\">");
      $x += 1;
    }
    echo("</div>\n");
  } else {
    mysqli_close($link);
  }
} else {
  echo("	<div class=\"viewcount\">
		<p style=\"text-align:center;\">
			お早うヰシュー様！
		</p>
	</div>\n");
}
include("{$_SERVER["DOCUMENT_ROOT"]}/assets/defaultFooter.php");
?>
