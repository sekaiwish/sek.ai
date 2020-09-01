<?php
header("Content-Type: application/json");
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$data = json_decode(file_get_contents("php://input"), true);
if ($data["new"] !== $data["confirm"]) {
  echo json_encode(0);
  exit;
}
$query = $dbi->prepare("SELECT password FROM users WHERE username = ?");
$query->bind_param("s", $_SESSION["username"]);
$query->execute();
$result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
if (empty($result)) {
  echo json_encode(1);
} else {
  if (password_verify($data["old"], $result[0]["password"])) {
    $password = password_hash($data["new"], PASSWORD_DEFAULT);
    $query = $dbi->prepare("UPDATE users SET password = ? WHERE username = ?");
    $query->bind_param("ss", $password, $_SESSION["username"]);
    $query->execute();
    echo json_encode(3);
  } else {
    echo json_encode(2);
  }
}
