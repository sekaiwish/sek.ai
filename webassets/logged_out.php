<!DOCTYPE html>
<html>
<head>
<meta name="robots" content="noindex">
<link rel="icon" href="/webassets/favicon.ico" type="image/x-icon">
<link rel="stylesheet" href="/webassets/loginStyle.css" type="text/css">
<title>Sekai: Login</title>
</head>
<body>
<div class="login">
<p class="loginHeader"><b>Log in to Sekai</b></p>
<?php
if(isset($_SESSION['loginerror'])) {
  echo('<p class="errorText">');
  if($_SESSION['loginerror'] == 1) {
    echo('User not found.');
  } elseif($_SESSION['loginerror'] == 2) {
    echo('Your account has not been approved yet.');
  } elseif($_SESSION['loginerror'] == 3) {
    echo('Incorrect password.');
  }
  echo('</p>');
  session_destroy();
}?>
<form style="text-align:center;color:white;" action="/access/login.php" method="post" accept-charset="UTF-8">
<label>Username</label><br>
<input type="text" placeholder="Enter Username" name="username" id="username" maxlength="16" required><br>
<label>Password</label><br>
<input type="password" placeholder="Enter Password" name="password" id="password" maxlength="16" required><br>
<a href="/register/"><button type="button">Register</button></a>
<button type="submit">Login</button>
</form>
</div>
<p class="beta">DEV 0.6</p>
<p class="pageTitle">Sekai</p>
<?php
  session_start();
  include($_SERVER["DOCUMENT_ROOT"].'/access/sql.php');
  $ip = $_SERVER['REMOTE_ADDR'];
  $getView = mysqli_query($link,'SELECT count FROM views ORDER BY count DESC LIMIT 1');
  $getView = mysqli_fetch_array($getView,MYSQLI_ASSOC);
  $newView = $getView['count'] + 1;
  if($ip != '::1' && $ip != '127.0.0.1') {
    if(mysqli_query($link,"INSERT INTO views (ip) VALUES ('$ip')")) {
      mysqli_close($link);
      echo('<div class="viewCount">
');
      $newView = str_split($newView);
      $places = count($newView);
      $x = 0;
      if(end($newView) == prev($newView)) {
        echo('<p style="text-align:center;">Checked!</p>
');
      }
      while($x < $places) {
        echo('<img src="/webassets/views/'.$newView[$x].'.gif">
');
        $x += 1;
      }
      echo('</div>
');
    } else {
      mysqli_close($link);
    }
  } else {
    echo('<div class="viewcount"><p style="text-align:center;">お早うヰシュー様!</p></div>');
  }?>
</body>
</html>
