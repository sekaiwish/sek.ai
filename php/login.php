<?php
header('Content-Type: application/json');
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$data = json_decode(file_get_contents('php://input'), true);
$stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$data['username']]);
$user = $stmt->fetch();
if (empty($user)) {
  echo json_encode(0);
} else {
  if (password_verify($data['password'], $user['password'])) {
    $_SESSION['username'] = $user['username'];
    echo json_encode(1);
  } else {
    echo json_encode(2);
  }
}
