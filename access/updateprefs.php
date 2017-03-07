<?php
session_start();
include($_SERVER["DOCUMENT_ROOT"].'/access/sql.php')
$linkset = "UPDATE login SET linkstyle='".$_POST["linkstyle"]."' WHERE userid='".$_SESSION["userid"]."'";
$tileset = "UPDATE login SET tilestyle='".$_POST["tilestyle"]."' WHERE userid='".$_SESSION["userid"]."'";
$postset = "UPDATE login SET postsshown='".$_POST["postsshown"]."' WHERE userid='".$_SESSION["userid"]."'";
if(mysqli_query($link, $linkset)) {
  if(mysqli_query($link, $tileset)) {
    if(mysqli_query($link,$postset)) {
      $_SESSION["linkstyle"] = $_POST["linkstyle"];
      $_SESSION["tilestyle"] = $_POST["tilestyle"];
      $_SESSION["postsshown"] = $_POST["postsshown"];
      header("Location: /");
    } else {
      echo("ERROR: ".mysqli_error($link));
    }
  } else {
    echo("ERROR: ".mysqli_error($link));
  }
} else {
  echo("ERROR: ".mysqli_error($link));
}
?>
