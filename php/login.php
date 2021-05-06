<?php
header('Content-Type: application/json');
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$data = json_decode(file_get_contents('php://input'), true);
$query = $dbi->prepare('SELECT * FROM users WHERE username = ?');
$query->bind_param('s', $data['username']);
$query->execute();
$result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
if (empty($result)) {
  echo json_encode(0);
} else {
  if (password_verify($data['password'], $result[0]['password'])) {
    $_SESSION['username'] = $result[0]['username'];
    echo json_encode(1);
  } else {
    echo json_encode(2);
  }
}
