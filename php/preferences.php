<?php
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
if($_POST["linkstyle"] > 1 || $_POST["linkstyle"] < 0) {
  $_POST["linkstyle"] = 0;
}
if($_POST["tilestyle"] > 2 || $_POST["tilestyle"] < 0) {
  $_POST["tilestyle"] = 0;
}
if($_POST["psotsshown"] > 15 || $_POST["psotsshown"] < 5) {
  $_POST["psotsshown"] = 10;
}
$linkset = "UPDATE login SET linkstyle='{$_POST["linkstyle"]}' WHERE username='{$_SESSION["username"]}'";
$tileset = "UPDATE login SET tilestyle='{$_POST["tilestyle"]}' WHERE username='{$_SESSION["username"]}'";
$postset = "UPDATE login SET postsshown='{$_POST["postsshown"]}' WHERE username='{$_SESSION["username"]}'";
if(mysqli_query($link, $linkset)) {
  if(mysqli_query($link, $tileset)) {
    if(mysqli_query($link,$postset)) {
      header("Location: /account/?success=1");
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
