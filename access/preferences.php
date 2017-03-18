<?php
session_start();
include("{$_SERVER['DOCUMENT_ROOT']}/access/sql.php");
$linkset = "UPDATE login SET linkstyle='{$_POST['linkstyle']}' WHERE username='{$_SESSION['username']}'";
$tileset = "UPDATE login SET tilestyle='{$_POST['tilestyle']}' WHERE username='{$_SESSION['username']}'";
$postset = "UPDATE login SET postsshown='{$_POST['postsshown']}' WHERE username='{$_SESSION['username']}'";
if(mysqli_query($link, $linkset)) {
  if(mysqli_query($link, $tileset)) {
    if(mysqli_query($link,$postset)) {
      header('Location: /account/?success=1');
    } else {
      echo("MYSQL ERROR: ".mysqli_error($link));
    }
  } else {
    echo("MYSQL ERROR: ".mysqli_error($link));
  }
} else {
  echo("MYSQL ERROR: ".mysqli_error($link));
}
?>
