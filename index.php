<?php
error_reporting(error_reporting()&~E_NOTICE);
session_start();
if(isset($_POST['logout'])) {
  session_destroy();
  header("Location: /");
  exit();
}
if(isset($_POST['preferences'])) {
  header("Location: /access/preferences.php");
  exit();
}
if($_SESSION["logged_in"] != TRUE) {
  include('webassets/logged_out.php');
} else {
  include('webassets/logged_in.php');
}
?>
