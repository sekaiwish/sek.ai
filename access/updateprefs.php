<?php
session_start();

$link = mysqli_connect("127.0.0.1","root","nig","login");
$linkset = "UPDATE login SET linkstyle='".$_POST["linkstyle"]."' WHERE userid='".$_SESSION["userid"]."'";
$tileset = "UPDATE login SET tilestyle='".$_POST["tilestyle"]."' WHERE userid='".$_SESSION["userid"]."'";

if(mysqli_query($link, $linkset)) {
  if(mysqli_query($link, $tileset)) {
    $_SESSION["linkstyle"] = $_POST["linkstyle"];
    $_SESSION["tilestyle"] = $_POST["tilestyle"];
    header("Location: /");
  } else {
    echo("ERROR: ".mysqli_error($link));
  }
} else {
  echo("ERROR: ".mysqli_error($link));
}
?>
