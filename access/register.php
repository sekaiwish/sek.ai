<?php
$username = $_POST["username"];
$usernameLower = strtolower($_POST["username"]);
$password = $_POST["password"];
$email = strtolower($_POST["email"]);

$link = mysqli_connect("127.0.0.1","root","nig","login");
$usercheck = 'SELECT username FROM login';
$get = mysqli_query($link, $usercheck);
$x = -1;
while($row = mysqli_fetch_array($get, MYSQLI_ASSOC)) {
  $x += 1;
  $users[$x] = $row;
}
$usercount = count($users);
for($y = 1; $y < $usercount; $y++) {
	$usersLower[$y] = strtolower($users[$y]["username"]);
}
if (in_array($username, $usersLower)) {
	header("Location: /registererror");
} else {
	$register = "INSERT INTO login (username, password, email, linkstyle, tilestyle)
	VALUES ('$username', '$password', '$email', '0', '0')";
	if(mysqli_query($link, $register)) {
			header("Location: /registered");
	} else {
		echo("ERROR: ".mysqli_error($link));
	}
}
?>
