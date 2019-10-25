<?php
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$query = $dbi->prepare("SELECT * FROM users WHERE username = ?");
$query->bind_param("s", $_POST["username"]);
$query->execute();
$result=$query->get_result()->fetch_all(MYSQLI_ASSOC);
if (empty($result)) {
  echo "0";
} else {
  if (password_verify($_POST["password"], $result[0]["password"])) {
    $_SESSION["username"] = $result[0]["username"];
    echo "1";
  } else {
    echo "2";
  }
}
