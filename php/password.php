<?php
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$query = $db->prepare("SELECT password FROM users WHERE username = (:username)");
$query->bindValue(":username", $_SESSION["username"], PDO::PARAM_STR);
$query->execute();
$password = $query->fetchColumn();
if (password_verify($_POST["old"], $password) && $_POST["new"] == $_POST["confirm"]) {
  $password = password_hash($_POST["new"], PASSWORD_DEFAULT);
  $query = $db->prepare("UPDATE users SET password = (:password) WHERE username = (:username)");
  $query->bindValue(":password", $password, PDO::PARAM_STR);
  $query->bindValue(":username", $_SESSION["username"], PDO::PARAM_STR);
  $query->execute();
  header("Location: /home/?s=1");
} else {
  header("Location: /home/?e=1");
}
?>
