<?php
session_start();
if($_SESSION["rank"] < 2) {
  header("Location: /error/403.html");
  exit();
}
include("{$_SERVER["DOCUMENT_ROOT"]}/access/sql.php");
$sql = mysqli_query($link, "SELECT username FROM login WHERE approved = '0'");
$count = mysqli_num_rows($sql);
for($x=0;$x<$count;$x++) {
  $unapproved = mysqli_fetch_array($sql, MYSQLI_ASSOC);
  if(isset($_POST["{$unapproved["username"]}"])) {
    $sql = mysqli_query($link, "UPDATE login SET approved = '1' WHERE username = '{$unapproved["username"]}'");
  }
}
mysqli_close($link);
header("Location: /admin/");
?>
