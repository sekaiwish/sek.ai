<?php
session_start();

$link = mysqli_connect("127.0.0.1","root","nig");
$sql = 'SELECT userid, username, password, approved, linkstyle, tilestyle FROM login';
mysqli_select_db($link, 'login');
$get = mysqli_query($link, $sql);
$x = -1;
while($row = mysqli_fetch_array($get, MYSQLI_ASSOC)) {
  $x += 1;
  $logins[$x] = $row;
}
mysqli_close($link);

$username = strtolower($_POST["username"]);
$password = $_POST["password"];
$logincount = count($logins);
for($y = 1; $y < $logincount; $y++) {
  $usernameLower[$y] = strtolower($logins[$y]["username"]);
  if($usernameLower[$y] == $username) {
    if($logins[$y]["approved"] == 1) {
      if($password == $logins[$y]["password"]) {
        $_SESSION["logged_in"] = TRUE;
        $_SESSION["username"] = $logins[$y]["username"];
        $_SESSION["userid"] = $logins[$y]["userid"];
        $_SESSION["linkstyle"] = $logins[$y]["linkstyle"];
        $_SESSION["tilestyle"] = $logins[$y]["tilestyle"];
        header("Location: /");
        exit();
      }
    } else {
      header("Location: /loginerror");
      exit();
    }
  } else {
    header("Location: /loginerror");
  }
}
header("Location: /loginerror");

# DEBUG
/*
$username = strtolower($_POST["username"]);
echo("Set VARusername ($username)<br>");
$password = $_POST["password"];
echo("Set VARpassword ($password)<br>");
$logincount = count($logins);
echo("Counted logins ($logincount)<br>");
for ($y = 1; $y < $logincount; $y++) {
  $usernameLower[$y] = strtolower($logins[$y]["username"]);
  echo("Set VARusernameLower (".$usernameLower[$y].")<br>");
  if ($usernameLower[$y] == $username) {
    if ($password == $logins[$y]["password"]) {
      echo("Set SVARlogged_in (TRUE)<br>");
      echo("Set SVARusername (".$logins[$y]["username"].")<br>");
      echo("Set SVARlinkstyle (".$logins[$y]["linkstyle"].")<br>");
      echo("Set SVARtilestyle (".$logins[$y]["tilestyle"].")<br>");
      echo("<br>Login success (".$logins[$y]["username"].")<br>");
      exit();
    } else {
      echo("Password did not match<br>");
    }
  } else {
    echo("Username did not match<br>");
  }
}
echo("Login failed")
*/
?>
