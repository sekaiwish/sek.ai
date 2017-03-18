<?php
$username = $_POST["username"];
$usernameLower = strtolower($_POST["username"]);
$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
$email = strtolower($_POST["email"]);
include($_SERVER["DOCUMENT_ROOT"].'/access/sql.php');
$get = mysqli_query($link,'SELECT username FROM login');
$x = -1;
while($row = mysqli_fetch_array($get,MYSQLI_ASSOC)) {
  $x += 1;
  $users[$x] = $row;
}
$usercount = count($users);
for($y = 1; $y < $usercount; $y++) {
	$usersLower[$y] = strtolower($users[$y]["username"]);
}
if(in_array($username, $usersLower)) {
  session_start();
  $_SESSION['registerError'] = 1;
	header("Location: /register/");
} else {
	$register = "INSERT INTO login (username, password, email, linkstyle, tilestyle)
	VALUES ('$username', '$password', '$email', '0', '0')";
	if(mysqli_query($link, $register)) {
      session_start();
      $_SESSION['registerStatus'] = 1;
			header("Location: /register/");
	} else {
		echo("ERROR: ".mysqli_error($link));
	}
}
?>
