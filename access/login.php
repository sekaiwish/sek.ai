<?php
session_start();
$link = mysqli_connect("127.0.0.1","root","nig");
$sql = 'SELECT userid, username, password, approved, linkstyle, tilestyle, postsshown FROM login';
mysqli_select_db($link, 'login');
$get = mysqli_query($link, $sql);
$x = -1;
while($row = mysqli_fetch_array($get, MYSQLI_ASSOC)) {
  $x += 1;
  $logins[$x] = $row;
}
mysqli_close($link);
$username = strtolower($_POST["username"]);
$logincount = count($logins);
for($y=1;$y<$logincount;$y++) {
  $usernameLower[$y] = strtolower($logins[$y]["username"]);
  if($usernameLower[$y] == $username) {
    if($logins[$y]["approved"] == 1) {
      if($_POST["password"] == $logins[$y]["password"]) {
        $_SESSION["logged_in"] = TRUE;
        $_SESSION["username"] = $logins[$y]["username"];
        $_SESSION["userid"] = $logins[$y]["userid"];
        $_SESSION["linkstyle"] = $logins[$y]["linkstyle"];
        $_SESSION["tilestyle"] = $logins[$y]["tilestyle"];
        $_SESSION["postsshown"] = $logins[$y]["postsshown"];
        header("Location: /");
        exit();
      } else {
        $_SESSION["loginerror"] = 3;
        header("Location: /");
        exit();
      }
    } else {
      $_SESSION["loginerror"] = 2;
      header("Location: /");
      exit();
    }
  } else {
    $_SESSION["loginerror"] = 1;
    header("Location: /");
  }
}
?>
