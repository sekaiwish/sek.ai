<?php
session_start();
include("{$_SERVER["DOCUMENT_ROOT"]}/php/sql.php");
$threads = $_POST["threads"];
if ($threads > 15) {
  $threads = 15;
}
if ($threads < 3) {
  $threads = 3;
}
$query = $db->prepare("UPDATE users SET threads = (:threads) WHERE username = (:username)");
$query->bindValue(":threads", $threads, PDO::PARAM_INT);
$query->bindValue(":username", $_SESSION["username"], PDO::PARAM_STR);
$query->execute();
$_SESSION["threads"] = $threads;
header("Location: /account/?s=1");
?>
