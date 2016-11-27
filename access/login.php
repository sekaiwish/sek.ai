<?php
session_start();
$usernames = array("WisH","minty","niggerlove");
$passwords = array("nigger","fresh","niggerlove");

$username = strtolower($_POST["username"]);
$password = $_POST["password"];
$usernamecount = count($usernames);
for ($x = 0; $x < $usernamecount; $x++) {
  $usernamesLower[$x] = strtolower($usernames[$x]);
  if ($usernamesLower[$x] == $username) {
    if ($password == $passwords[$x]) {
      header("Location: /");
      $_SESSION["logged_in"] = TRUE;
      $_SESSION["username"] = $usernames[$x];
      exit();
    } else {
      header("Location: /loginerror");
      exit();
    }
  } else {
    header("Location: /loginerror");
  }
}
header("Location: /loginerror");
?>
