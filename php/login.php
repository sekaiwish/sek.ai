<?php
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$query = $db->prepare("SELECT * FROM users WHERE username = (:username)");
$query->bindValue(":username", $_POST["username"], PDO::PARAM_STR);
$query->execute();
$result = $query->fetchAll();
if (empty($result)) {
  header("Location: /?e=1");
} else {
  if (password_verify($_POST["password"], $result[0][3])) {
    $_SESSION["rank"] = $result[0][1];
    $_SESSION["username"] = $result[0][2];
    $_SESSION["threads"] = $result[0][4];
    header("Location: /chan/");
  } else {
    header("Location: /?e=2");
  }
}
?>
