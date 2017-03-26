<?php
include("{$_SERVER['DOCUMENT_ROOT']}/access/recaptcha.php");
$data = array('secret' => "$recaptcha",
'response' => "{$_POST['g-recaptcha-response']}",
'remoteip' => "{$_SERVER['REMOTE_ADDR']}");
$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data)
    )
);
$context = stream_context_create($options);
$result = file_get_contents('https://www.google.com/recaptcha/api/siteverify', false, $context);
$success = json_decode($result,true);
if($success['success'] != 1) {
  session_start();
  $_SESSION['registerError'] = 1;
  header('Location: /register/');
  exit();
}
$username = $_POST["username"];
preg_match('/^(?=.{1,16}$)(?![_.-])(?!.*[_.-]{2})[a-zA-Z0-9._-]+(?<![_.-])$/', "$username", $matches, PREG_OFFSET_CAPTURE);
if(!isset($matches[0])) {
  session_start();
  $_SESSION['registerError'] = 2;
	header('Location: /register/');
  exit();
}
$usernameLower = strtolower($_POST["username"]);
$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
$email = strtolower($_POST["email"]);
include("{$_SERVER['DOCUMENT_ROOT']}/access/sql.php");
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
if(in_array($usernameLower,$usersLower)) {
  session_start();
  $_SESSION['registerError'] = 3;
	header('Location: /register/');
  exit();
} else {
	$register = "INSERT INTO login (username, password, email, linkstyle, tilestyle)
	VALUES ('$username', '$password', '$email', '0', '0')";
	if(mysqli_query($link,$register)) {
      session_start();
      $_SESSION['registerStatus'] = 1;
			header("Location: /register/");
	} else {
		echo("ERROR: ".mysqli_error($link));
	}
}
?>
