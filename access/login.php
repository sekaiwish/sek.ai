<?php
session_start();
include("{$_SERVER['DOCUMENT_ROOT']}/access/sql.php");
$getData = mysqli_query($link,"SELECT password, approved FROM login WHERE username = '{$_POST['username']}'");
if($userData = mysqli_fetch_array($getData,MYSQLI_ASSOC)) {
  if($userData['approved'] == 1) {
    if(password_verify($_POST['password'],$userData['password'])) {
      $getData = mysqli_query($link,"SELECT userid, username, linkstyle, tilestyle, postsshown FROM login WHERE username = '{$_POST['username']}'");
      $userData = mysqli_fetch_array($getData,MYSQLI_ASSOC);
      $logData = mysqli_query($link,"INSERT INTO login_logs (userid) VALUES ('{$userData['userid']}')");
      $_SESSION['userid'] = $userData['userid'];
      $_SESSION['username'] = $userData['username'];
      $_SESSION['linkstyle'] = $userData['linkstyle'];
      $_SESSION['tilestyle'] = $userData['tilestyle'];
      $_SESSION['postsshown'] = $userData['postsshown'];
      $_SESSION['logged_in'] = TRUE;
      header('Location: /');
      exit();
    } else {
      $_SESSION['loginerror'] = 3;
      header('Location: /');
      exit();
    }
  } else {
    $_SESSION['loginerror'] = 2;
    header('Location: /');
    exit();
  }
} else {
  $_SESSION['loginerror'] = 1;
  header('Location: /');
  exit();
}
?>
