<?php
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$username = $_POST["username"];
$password = $_POST["password"];
$q = $db->prepare("SELECT password FROM users WHERE username = (:username)");
$q->bindValue(":username", $username, PDO::PARAM_STR);
$q->execute();
$result = $q->fetchColumn();
if ($result === FALSE) {
  print("false user");
} else {
  if (password_verify($password, $result)) {
    print("verified");
  } else {
    print("false password");
  }
}
?>
